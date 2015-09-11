@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

{{-- Style --}}
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/themes/default/style.min.css">
@stop

{{-- Content --}}
@section('content')
  <div class="page-header">
    <h3>
      {{{ $title }}}
      <div class="pull-right">
        <div class="input-groupe form-inline">
          <span class="input-grpup-addon">{{ Lang::get('filters.search') }}</span>
          <input id="tree_q" class="form-control">
        </div>
      </div>
    </h3>
  </div>
  <div id="alert" class="alert alert-warning hide" role="alert">
    <span class="pull-right">x</span>
    <ul></ul>
  </div>
  {{ Form::token() }}
  <div id="tree">
  </div>
@stop

{{-- Scripts --}}
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/jstree.min.js"></script>
<script>

$(document).ready(function() {
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
    "plugins" : [
      "dnd", // drag 'n drop
      "search", // search in the tree (nedd additional code)
      "wholerow" // click everywhere on the row to select
    ]
  })
  // get info each time an element is select
  .bind("changed.jstree", function (e, data) {
    console.log("The selected nodes are:");
    console.log(data.selected);
  });

  // get info each time a drag 'n drop end
  $(document).on("dnd_stop.vakata", function (e, data) {
    var node = $('#tree').jstree().get_node(data.data.nodes[0]);
    $.ajax({
      url: "{{ URL::to('admin/categories/') }}/" + node.id + "/update",
      method: "POST",
      data: {
        _token: $('input[name=_token]')[0].value,
        _parent: node.parent,
      }
    })
    .done(function (data) {
      $('#alert ul')
        .empty()
      if (data.success) {
        $('#alert ul').append("<li>{{ Lang::get('admin/categories/messages.success') }}</li>");
        $('#alert').removeClass('alert-warning').addClass('alert-success');
      } else {
        data.errors.forEach( function (arrayItem) {
          $('#alert ul').append("<li>" + arrayItem + "</li>");
        });
        $('#alert').removeClass('alert-success').addClass('alert-warning');
        $('#tree').jstree('refresh');
      }
      $('#alert').removeClass('hide');
      console.log(data);
    });
  });

  // highlight node based on search
  var to = false;
  $('#tree_q').keyup(function () {
    if(to) { clearTimeout(to); }
      to = setTimeout(function () {
        var v = $('#tree_q').val();
        $('#tree').jstree(true).search(v);
      }, 250);
  });

  // hide error
  $('#alert span').click(function () { $('#alert').addClass('hide'); });

});

</script>
@stop
