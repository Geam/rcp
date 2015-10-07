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

<!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/select2/select2.min.css') }}"> -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/datepicker/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/css/dataTables.bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/jstree/css/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/tooltip/css/tooltip.css') }}">
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

  <ul class="nav nav-tabs" role="tablist">
    {{ Form::tabs_upper_part('adv_search', 'active', ''); }}
    {{ Form::tabs_upper_part('categories', '', Lang::get('tooltips.main_keywords')); }}
  </ul>
  <div class="tab-content">
    <div class="tab-pane active form-horizontal" id="tab_adv_search">

      <div class="form-group">
        <!-- Post Content -->
        <div class="col-md-12">
          {{ Form::label_tooltip('r_content', Lang::get('filters.content'), Lang::get('tooltips.main_content'),  [ 'class' => 'control-label' ]) }}
          {{ Form::text('r_content', null, [ 'class' => 'form-control', 'onkeyup' => 'checkEnter(this, event)', 'id' => 'r_content' ]) }}
        </div>
        <!-- ./ post content -->
      </div>

      <div class="form-group">
        <!-- Post Title -->
        <div class="col-md-6">
          {{ Form::label_tooltip('r_title', Lang::get('filters.title'), Lang::get('tooltips.main_title'), [ 'class' => 'control-label' ]) }}
          {{ Form::text('r_title', null, [ 'class' => 'form-control', 'id' => "r_title", 'onkeyup' => 'checkEnter(this, event)' ]) }}
        </div>
        <!-- ./ post title -->

        <!-- Post state -->
        <div class="col-md-6">
          {{ Form::label_tooltip('r_state', Lang::get('filters.state'), Lang::get('tooltips.main_state'),  [ 'class' => "control-label" ]) }}
          {{ Form::selectStateOrLang('r_state', 'state', [
            'attr' => [
              'class' => 'form-control',
              'onchange' => 'requestData()'
            ],
            'avail' => null
            ]) }}
        </div>
        <!-- ./ post state -->
      </div>

      <div class="form-group">
        <!-- Post affair_id -->
        <div class="col-md-6">
          {{ Form::label_tooltip('r_affair_id', Lang::get('filters.affair_id'), Lang::get('tooltips.main_affair_id'), [ 'class' => 'control-label' ]) }}
          {{ Form::text('r_affair_id', null, [ 'class' => 'form-control', 'onkeyup' => 'checkEnter(this, event)', 'id' => "r_affair_id" ]) }}
        </div>
        <!-- ./ post affair_id -->

        <!-- Post date -->
        <div class="col-md-6">
          {{ Form::label_tooltip('r_date', Lang::get('filters.date'), Lang::get('tooltips.main_date'), [ 'class' => 'control-label' ]) }}
          {{ Form::inputDate('r_date', True) }}
        </div>
        <!-- ./ post date -->
      </div>

      <div class="form-group">
        <!-- Post post_lang -->
        <div class="col-md-6">
          {{ Form::label_tooltip('r_lang', Lang::get('filters.lang'), Lang::get('tooltips.main_lang'), [ 'class' => 'control-label' ]) }}
          {{ Form::selectStateOrLang('r_lang', 'lang', [
            'attr' => [
              'class' => 'form-control',
              'onchange' => 'requestData()'
            ],
            'avail' => null
            ]) }}
        </div>
        <!-- ./ post post_lang -->

        <!-- post nature -->
        <div class="col-md-6">
          {{ Form::label_tooltip('r_nature', Lang::get('filters.nature'), Lang::get('tooltips.main_nature'), [ 'class' => "control-label" ]) }}
          {{ Form::nature('r_nature', [
            'attr' => [
              'class' => 'form-control',
              'onchange' => 'requestData()'
            ],
            'default' => null
          ], true) }}
        </div>
        <!-- ./ post nature -->
      </div>

      <div class="form-group">
        <!-- Post importance -->
        <div class="col-md-12">
          {{ Form::label_tooltip('r_importance', Lang::get('filters.importance'), Lang::get('tooltips.main_importance'), [ 'class' => "control-label" ]) }}
          {{ Form::select(
            'r_importance',
            [ 0 => Lang::get('filters.all'), 1 => 1, 2 => 2, 3 => 3, 4 => 'CR'],
            0,
            [ 'class' => "form-control", 'id' => "r_importance", 'onchange' => 'requestData()' ]
          ) }}
        </div>
        <!-- ./ post importance -->
      </div>

      <div class="form-group">
        <div class="col-md-12">
          {{ Form::only_my_lang('r_oml', Lang::get('filters.oml_extend'), Lang::get('tooltips.main_oml'), 'value') }}
        </div>
      </div>

    </div>

    <div class="tab-pane" id="tab_categories">
    {{ Form::jsTreeSearch('tree') }}
    </div>
  </div>
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
<!--
<tr>
<th><input type="text" placeholder="{{ lang::get('filters.title') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.affair_id') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.importance') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.nature') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.lang') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.state') }}"></th>
<th><input type="text" placeholder="{{ lang::get('filters.date') }}"></th>
</tr>
-->
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
  <!-- <script src="{{ asset('assets/select2/select2.min.js') }}"></script> -->
  <script src="{{ asset('assets/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/js/dataTables.bootstrap.js') }}"></script>
<!--  <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/sorting/numeric-comma.js"></script> -->
  <script src="{{ asset('assets/jstree/js/jstree.min.js') }}"></script>
<script type="text/javascript">

// var for categories filters
var gTable = {};

// select to transform in select2
$( document ).ready(function() {
  // add the select
  //$('#r_lang').select2({ width: '100%' });
  //$('#r_state').select2({ width: '100%' });

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
      //      $('thead th input').each( function (id) {
      //        $(this).on('keyup change', function () {
      //          gTable.table
      //            .column( id )
      //            .search( this.value )
      //            .draw();
      //        });
      //      });

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
        })
      .bind("hover_node.jstree", function (e, data) {
        console.log(data.node.original.long);
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
      $('#r_title')[0].value = '';
      $('#r_importance')[0].value = '';
      $('#r_nature')[0].value = 'judgement';
      $('#r_affair_id')[0].value = '';
      $('#r_date')[0].value = '';
      $('#r_date_2')[0].value = '';
      $('#r_lang')[0].value = '00';
      $('#r_state')[0].value = '00';
      $('#r_content')[0].value = '';
      $('#only_my_lang').prop( "checked", false );
      if (! $( '#alerts' )[0].className.match('hide')) {
        $( '#alerts' )[0].className += 'hide';
        $( '#alerts' ).empty();
      }
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

      // get the fields
      r_json['title'] = $('#r_title')[0].value;
      r_json['importance'] = $('#r_importance')[0].value;
      r_json['nature'] = $('#r_nature')[0].value;
      r_json['affair_id'] = $('#r_affair_id')[0].value;
      r_json['date'] = $('#r_date')[0].value;
      r_json['date_2'] = $('#r_date_2')[0].value;
      r_json['lang'] = $('#r_lang')[0].value;
      r_json['state'] = $('#r_state')[0].value;
      r_json['oml'] = $('#only_my_lang').is(':checked');
      r_json['content'] = $('#r_content')[0].value;

      // get the select categories
      r_json['category'] = $('#tree').jstree(true).get_selected();

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
