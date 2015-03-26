@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

{{-- Styles --}}
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/themes/default/style.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@stop

{{-- Content --}}
@section('content')
  <div class="page-header">
    <span class="h3"> {{{ $title }}}</span>
    {{ Form::token() }}
    <div class="pull-right form-inline form-group">
      <label class="control-label" for="edit_lang">{{ Lang::get('admin/categories/translation.select_lang') }}</label>
    {{ Form::selectStateOrLang('edit_lang', 'lang', [
      'attr' => ['class' => 'form-control', 'autocomplete' => 'off'],
      'noall' => 'noall',
      'avail' => ['default' => App::getLocale() ]
      ]) }}
    </div>
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
  <div id="tree">
  </div>
@stop

{{-- Scripts --}}
@section('scripts')
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/jstree.min.js"></script>

<script>

$(document).ready(function() {
  var alerts, select, dialog, form, tree;

  select = $('#edit_lang').on('change', function() {
    tree.refresh();
  });

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
        url: "{{ URL::to('admin/categories/translation/rename') }}",
        method: "POST",
        data: {
          _token: $('input[name=_token]')[0].value,
          _id: data.node.id,
          _long: $(this).find('textarea')[0].value,
          _short: data.text,
          _lang: select.val()
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

  $('#tree').jstree({
    core: {
      animation: 0,
      check_callback: true,
      themes: { "stripes": true },
      data: {
        url: function (node) {
          return "{{ URL::to('admin/categories/translation/data') }}/" + select.val();
        },
        dataType: "json"
      },
    },
    plugins: [
      "contextmenu",
      "search",
      "wholerow"
    ],
    contextmenu: {
      "items": function (node) {
        return {
          renameItem: {
            label: "{{ Lang::get('admin/categories/buttons.rename') }}",
            action: function () {
              tree.edit(node);
            }
          }
        };
      }
    }
  })
  .on('rename_node.jstree', function (e, data) {
    if (data.node.original.long)
      $('textarea')[0].value = data.node.original.long;
    else
      $('textarea')[0].value = data.text;
    lastRename = data;
    dialog.dialog( "open" );
  });

  tree = $('#tree').jstree(true);

});

</script>
@stop
