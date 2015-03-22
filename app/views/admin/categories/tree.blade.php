@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

{{-- Style --}}
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/themes/default/style.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}
		</h3>
	</div>
  <div id="alert" class="alert alert-warning hide" role="alert">
    <span class="pull-right">x</span>
    <ul></ul>
  </div>
  <div id="dialog-form" title="{{ Lang::get('admin/categories/messages.tooltip') }}">
    <p class="validateTips">{{ Lang::get('admin/categories/messages.tooltip_extra') }}</p>
    <form id="toto">
      <fieldset>
        <textarea type="text" name="long" id="long" form="toto" cols="35" rows="4" class="text ui-widget-content ui-corner-all"></textarea>

        <!-- Allow form submission with keyboard without duplicating the dialog button -->
        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
      </fieldset>
    </form>
  </div>
  {{ Form::token() }}
  <div class="row">
    <div class="col-md-4 col-sm-8 col-xs-8">
      <button type="button" class="btn btn-success btn-sm" onclick="tree_create();"><i class="glyphicon glyphicon-asterisk"></i> {{ Lang::get('admin/categories/buttons.create') }}</button>
      <button type="button" class="btn btn-warning btn-sm" onclick="tree_rename();"><i class="glyphicon glyphicon-pencil"></i> {{ Lang::get('admin/categories/buttons.rename') }}</button>
      <button type="button" class="btn btn-danger btn-sm" onclick="tree_delete();"><i class="glyphicon glyphicon-remove"></i> {{ Lang::get('admin/categories/buttons.delete') }}</button>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-4 pull-right">
      <input type="text" value="" class="form-control" id="tree_q" placeholder="{{ Lang::get('filters.search') }}" />
    </div>
  </div>
  <div id="tree">
  </div>
@stop

{{-- Scripts --}}
@section('scripts')
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/jstree.min.js"></script>
<script>

$(document).ready(function() {
  var alerts, dialog, form, lastRename;

  // object create for error management
  alerts = {
    clear: function () {
      $('#alert ul').empty();
      this.hide();
    },
    show: function () {
      $('#alert').removeClass('hide');
    },
    hide: function () {
      $('#alert').addClass('hide');
    },
    success: function (msg) {
      $('#alert ul').empty();
      $('#alert ul').append("<li>" + msg + "</li>");
      $('#alert').removeClass('alert-warning alert-danger').addClass('alert-success');
      this.show();
    },
    warnings: function (errors) {
      $('#alert ul').empty();
      errors.forEach( function (arrayItem) {
        $('#alert ul').append("<li>" + arrayItem + "</li>");
      });
      $('#alert').removeClass('alert-success alert-danger').addClass('alert-warning');
      this.show();
    },
    danger: function (error) {
      $('#alert ul').empty();
      $('#alert ul').append("<li>" + error + "</li>");
      $('#alert').removeClass('alert-success alert-warning').addClass('alert-danger');
      this.show();
    }
  };

  // box called when renaming
  dialog = $( "#dialog-form" ).dialog({
    autoOpen: false,
    height: 300,
    width: 350,
    modal: true,
    buttons: {
      "{{ Lang::get('admin/categories/buttons.submit') }}": function() {
        dialog.dialog( "close" );
      }
    },
    close: function() {
      var data = lastRename;
      $.ajax({
        url: "{{ URL::to('admin/categories/manage/rename') }}",
        method: "POST",
        data: {
          _token: $('input[name=_token]')[0].value,
          _id: data.node.id,
          _long: $(this).find('textarea')[0].value,
          _short: data.text
        }
      })
        .done( function (ret) {
          console.log(ret);
          if (ret.success) {
            alerts.success("{{ Lang::get('admin/categories/messages.success.update') }}");
            data.node.original.long = ret.cat.long_name;
          } else {
            alerts.warnings(ret.errors);
            data.node.text = data.node.old;
          }
          $('#tree').jstree(true).redraw(true);
        })
        .fail (function (ret) {
          alerts.danger("{{ Lang::get('admin/categories/messages.error.unknown') }}");
        });
      form[ 0 ].reset();
    }
  });

  // form validation with keyboard
  form = dialog.find( "form" ).on( "submit", function( event ) {
    event.preventDefault();
  });

  // tree initialisation
  $('#tree').jstree({
    core: {
      animation: 0,
      check_callback: true,
      themes: { "stripes": true },
      data: {
        url: "{{ URL::to('admin/categories/datadefault') }}",
        dataType: "json"
      },
    },
    plugins: [
      "contextmenu", // context menu
      "dnd", // drag 'n drop
      "search", // search in the tree (need additional code)
      "wholerow" // click everywhere on the row to select
    ],
    contextmenu: {
      "items": customMenu
    }
  })
  // get info each time an element is select
  .bind("changed.jstree", function (e, data) {
    console.log("The selected nodes are:");
    console.log(data.selected);
  })
  .on("create_node.jstree", function (e, data) {
    // create a copy in memory - DO NOT MODIFY THE ORIGINAL
    var node = $.extend(true, {}, data.node);
    node.name = node.text;
    node.parentId = data.node.parent;

    // ask the serveur for the id
    $.ajax({
      url: "{{ URL::to('admin/categories/manage/addchild') }}",
      method: "POST",
      context: this,
      data: {
        _token: $('input[name=_token]')[0].value,
        _parent: node.parent,
      },
    })
      .done( function (ret) {
        alerts.clear();
        if (ret.success) {
          data.instance.set_id(node, ret.node);
          data.instance.edit(ret.node);
          alerts.success("{{ Lang::get('admin/categories/messages.success.addChild') }}");
        } else {
          alerts.warnings(ret.errors);
          $('#tree').jstree(true).delete_node(data.node.id);
        }
      })
      .fail( function (ret) {
        alerts.danger("{{ Lang::get('admin/categories/messages.error.unknown') }}");
        $('#tree').jstree(true).delete_node(data.node.id);
      });
  })
  .on("rename_node.jstree", function (e, data) {
    if (data.node.original.long)
      $('textarea')[0].value = data.node.original.long;
    else
      $('textarea')[0].value = data.text;
    lastRename = data;
    dialog.dialog( "open" );
  })
  .on("delete_node.jstree", function (e, data) {
    console.log(data);
    // in case the node is delete just after creation cause the serveur
    // because the server can't be reach or it can't add the categorie
    // just remove the localy add node
    if (data.node.id.substring(0,3) == "j1_")
      return ;
    $.ajax({
      url: "{{ URL::to('admin/categories/manage/" + data.node.id + "/delete') }}",
      method: "POST",
      data: {
        _token: $('input[name=_token]')[0].value,
        _children: data.node.children_d
      }
    })
      .done (function (ret) {
        console.log(ret);
      })
      .fail (function (ret) {
        console.log(ret);
      });
  });

  // update node on server on drag 'n drop end
  $(document).on("dnd_stop.vakata", function (e, data) {
    var node = $('#tree').jstree().get_node(data.data.nodes[0]);
    $.ajax({
      url: "{{ URL::to('admin/categories/manage') }}/" + node.id + "/update",
      method: "POST",
      data: {
        _token: $('input[name=_token]')[0].value,
        _parent: node.parent,
      }
    })
    .done(function (data) {
      if (data.success) {
        alerts.success("{{ Lang::get('admin/categories/messages.success.update') }}");
      } else {
        alerts.warnings(data.errors);
        $('#tree').jstree('refresh');
      }
    })
    .fail( function (data) {
      alerts.danger("{{ Lang::get('admin/categories/messages.error.unknown') }}");
    });
  });

  // highlight tree node based on search
  var to = false;
  $('#tree_q').keyup(function () {
    if(to) { clearTimeout(to); }
      to = setTimeout(function () {
        var v = $('#tree_q').val();
        $('#tree').jstree(true).search(v);
      }, 250);
  });

  // hide error
  $('#alert span').click(function () { alerts.hide(); });

  function customMenu(node) {
    var items = {
      addItem: {
        label: "{{ Lang::get('admin/categories/buttons.create') }}",
        action: function () {
          $('#tree').jstree(true).create_node(node);
        },
      },
      renameItem: {
        label: "{{ Lang::get('admin/categories/buttons.rename') }}",
        action: function () {
          $('#tree').jstree(true).edit(node);
        },
      },
      deleteItem: {
        label: "{{ Lang::get('admin/categories/buttons.delete') }}",
        action: function () {
          if (confirm("{{ Lang::get('admin/categories/messages.delete') }} " + node.children_d.length + " {{ Lang::get('admin/categories/messages.delete_end') }}" ))
            $('#tree').jstree(true).delete_node(node);
        }
      },
    };

    return items;
  };
});

// function called when the create button is clicked
function tree_create() {
  var ref = $('#tree').jstree(true),
    dad = ref.get_selected();
  if (!dad.length) {
    return false;
  }
  dad = dad[0];
  sel = ref.create_node(dad);
};

// function called when the rename button is clicked
function tree_rename() {
  var ref = $('#tree').jstree(true),
    sel = ref.get_selected();
  if (!sel.length) {
    return false;
  }
  sel = sel[0];
  ref.edit(sel);
};

// function called when the delete button is clicked
function tree_delete() {
  var ref = $('#tree').jstree(true),
    sel = ref.get_selected();
  if (!sel.length) {
    return false;
  }
  console.log(ref.get_node(sel));
  if (confirm("{{ Lang::get('admin/categories/messages.delete') }} " + ref.get_node(sel).children_d.length + " {{ Lang::get('admin/categories/messages.delete_end') }}" ))
    ref.delete_node(sel);
};

</script>
@stop
