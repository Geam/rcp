@extends('site.layouts.default')

{{-- Style --}}
@section('styles')
<style>
.tab-content {
  padding-top: 1em;
}

#s2id_r_lang,
#s2id_r_state {
  padding-left: 0px;
  padding-right: 0px;
}

</style>

<link rel="stylesheet" href="{{ asset('select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('datepicker/css/bootstrap-datepicker.min.css') }}">
<link href="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/themes/default/style.min.css">
@stop

{{-- Title --}}
@section('title')
{{ Lang::get('site.title') }}
@stop

{{-- Content --}}
@section('content')
<div id="alerts" class="alert alert-warning hide" role="alert"></div>
<div class="jumbotron">
{{ Form::token() }}
{{ Tabbable::withContents([
  [
    'title' => Lang::get('filters.category'),
    'content' => Form::jsTreeSearch('tree')
  ],
  [
    'title' => Lang::get('filters.range'),
    'content' => Form::inputDate('r_date', True)
  ],
  [
    'title' => Lang::get('filters.content'),
    'content' => Form::text('r_content', null, ['class' => 'form-control', 'onkeyup' => 'checkEnter(this, event)', 'id' => 'r_content'])
  ],
  [
    'title' => Lang::get('filters.only_my_lang'),
    'content' => Form::only_my_lang('only_my_lang', Lang::get('filters.oml_extend'), 'value')
  ]
]) }}
</div>

<div id="results" class="well" style="background: #FFF">
<table id="oTable" class="table table-striped table-hover table-bordered">
<thead>
<tr>
<th>{{ lang::get('filters.title') }}</th>
<th>{{ lang::get('filters.affair_id') }}</th>
<th>{{ lang::get('filters.importance') }}</th>
<th>{{ lang::get('filters.nature') }}</th>
<th>{{ lang::get('filters.lang') }}</th>
<th>{{ lang::get('filters.state') }}</th>
<th>{{ lang::get('filters.date') }}</th>
</tr>
<tr>
<th><input type="text" placeholder="{{ lang::get('filters.title') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.affair_id') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.importance') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.nature') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.lang') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.state') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.date') }}"></th>
</tr>
</thead>
<tfoot>
<tr>
<th>{{ lang::get('filters.title') }}</th>
<th>{{ lang::get('filters.affair_id') }}</th>
<th>{{ lang::get('filters.importance') }}</th>
<th>{{ lang::get('filters.nature') }}</th>
<th>{{ lang::get('filters.lang') }}</th>
<th>{{ lang::get('filters.state') }}</th>
<th>{{ lang::get('filters.date') }}</th>
</tr>
</tfoot>
<tbody id="table-content">
</tbody>
</table>
</div>
@stop

{{-- Scripts --}}
@section('scripts')

  <!-- Select2 script -->
  <script src="{{ asset('select2/select2.min.js') }}"></script>
  <script src="{{ asset('datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
  <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/sorting/numeric-comma.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/jstree.min.js"></script>
  <script type="text/javascript">

    // var for categories filters
    var gTable = {};

    // select to transform in select2
    $( document ).ready(function() {
      // add the select
      $('#r_lang').select2({ width: '100%' });
      $('#r_state').select2({ width: '100%' });

      // add the reset
      $('.nav-tabs').append('<li class="navbar-right" id="reset" onclick="reset()"><a>{{ Lang::get('filters.reset') }}</a></li>');

      // initiate datepicker
      $('input[id^="r_date"]').datepicker({
        startView: 1,
        orientation: "top auto",
        language: "{{ App::getLocale() }}",
        autoclose: true,
        format: "dd-mm-yyyy",
      });

      // init dataTable
      gTable.table = $('#oTable').DataTable( {
        "scrollX": true,
        "bSortCellsTop": true,
        "ajax": {
          "url": "search",
          "type": "POST",
          "data": function () { return buildAjaxObj(); }
        },
        "columns": [
          { "data": "title" },
          { "data": "affair_id" },
          { "data": "importance" },
          { "data": "nature" },
          { "data": "lang" },
          { "data": "state" },
          { "data": "date" }
        ],
        "columnDefs": [
          { "type": "numeric-comma", targets: 3 }
        ],
        "language": {
          "url": "{{ Lang::get('filters.dataTable') }}"
        },
        "initComplete" : function () {
          // needed to avoid ugly paginate
          $('#oTable_paginate')
            .removeClass('dataTables_paginate')
            .css( {
              'float': 'right'
            } )
            .find('ul')
              .css( {
                'margin': '8px 0px 0px 0px'
              } );
          // hide the duplicate sort icon
          $('.dataTables_scrollBody thead tr').addClass('hidden');
        },
        "drawCallback": function () {
          // hide the duplicate sort icon
          $('.dataTables_scrollBody thead tr').addClass('hidden')
        }
      });

      // apply the filter to dataTable
      $('thead th input').each( function (id) {
        $(this).on('keyup change', function () {
          gTable.table
            .column( id )
            .search( this.value )
            .draw();
        });
      });

      // when a row is clik, open the affair in new tab
      $('#oTable tbody').on('click', 'tr', function(e) {
        window.open(gTable.table.row( this ).data().url, gTable.table.row(this).data().title);
      });

      // init the categorie tree
      $('#tree').jstree({
        core: {
          animation: 0,
          check_callback: true,
          theme: { stripes: true },
          data: {
            url: "{{ URL::to('cattree') }}",
            dataType: "json"
          },
        },
        plugins: [
          "checkbox", // allow multi selecting
          "search", // search in the tree (need additional code)
          "wholerow", // click everywhere on the row to select
        ]
      })
        .bind("changed.jstree", function (e, data) {
          requestData();
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
    });

    function reset() {
      $('#r_date')[0].value = '';
      $('#r_date_2')[0].value = '';
      $('#r_content')[0].value = '';
      $('#only_my_lang').prop( "checked", false );
      if (! $( '#alerts' )[0].className.match('hide')) {
        $( '#alerts' )[0].className += 'hide';
        $( '#alerts' ).empty();
      }
      $('thead th input').each( function () {
        this.value = "";
      });
      requestData();
    }

    function checkEnter(elem,e) {
      var code = e.keyCode || e.which;
       if(code == 13) { //Enter keycode
         requestData();
        }
    }

    function buildAjaxObj() {
      // create object for request
      var r_json = {};

      // get the select categories
      r_json['category'] = $('#tree').jstree(true).get_selected();

      // search the filter to send to server
      r_json['date'] = $('#r_date')[0].value;
      if (! $('#r_date_2')[0].className.match('hide'))
        r_json['date_2'] = $('#r_date_2')[0].value;
      r_json['content'] = $('#r_content')[0].value;
      r_json['oml'] = $('#only_my_lang').is(':checked');

      // add the token or the server hung up
      r_json['_token'] = $('input[name=_token]')[0].value;

      // return rquest object
      return r_json;
    }

    $('#only_my_lang').on('change', requestData);

    function requestData() {

      // reload dataTable with function set at initialisation
      gTable.table.ajax.reload( function (json) {
        if (! json.success) {
          console.log(json);

          // clear alert zone
          $( '#alerts' ).empty();

          // add error msgs
          $( '#alerts' ).append('<ul>');
          json.msgs.forEach( function (arrayItem) {
            $( '#alerts' ).append('<li>' + arrayItem + '</li>');
          });
          $( '#alerts' ).append('</ul>');

          // display div
          $( '#alerts' ).removeClass('hide');
        } else {
          // hide div
          $( '#alerts' ).addClass('hide');
        }
      });

    }

    </script>
@stop
