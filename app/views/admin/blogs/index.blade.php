@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

{{-- Content --}}
@section('content')
  <div class="page-header">
    <h3>
      {{{ $title }}}

      <div class="pull-right">
        <a href="{{{ URL::to('admin/affairs/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
      </div>
    </h3>
  </div>

  <table id="oTable" class="table table-striped table-hover">
    <thead>
      <tr>
        <th class="col-md-3">{{{ Lang::get('admin/blogs/table.title') }}}</th>
        <th class="col-md-1">{{{ Lang::get('admin/blogs/table.affair_id') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/blogs/table.importance') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/blogs/table.lang') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/blogs/table.state') }}}</th>
        <th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th class="col-md-3">{{{ Lang::get('admin/blogs/table.title') }}}</th>
        <th class="col-md-1">{{{ Lang::get('admin/blogs/table.affair_id') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/blogs/table.importance') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/blogs/table.lang') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/blogs/table.state') }}}</th>
        <th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
      </tr>
    </tfoot>
    <tbody>
    </tbody>
  </table>
@stop

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
var oTable;
$(document).ready(function() {
  // add input filter to dataTable
  $('#oTable tfoot th').each( function () {
    var title = $('#oTable thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" placeholder="{{ Lang::get('filters.search') }} '+title+'" />' );
  } );

  // init the dataTable
  oTable = $('#oTable').DataTable( {
    "dom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
      "language": {
        "url": "{{ Lang::get('filters.dataTable') }}"
      },
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "{{ URL::to('admin/affairs/data') }}",
      },
      "drawCallback": function ( oSettings ) {
        $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
      }
  });

  // apply the filter to dataTable
  oTable.columns().eq( 0 ).each( function ( colIdx ) {
    $( 'input', oTable.column( colIdx ).footer() ).on( 'keyup change', function () {
      if (oTable.column(colIdx).footer().childNodes[0] == this) {
        oTable
          .column( colIdx )
          .search( this.value )
          .draw();
        console.log(colIdx);
        console.log(this);
      }
    } );
  });
});
</script>
@stop
