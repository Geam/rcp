@extends('site.layouts.default')

{{-- Title --}}
@section('title')
  Administration
@stop

{{-- Style --}}
@section('styles')
  <link rel="stylesheet" href="{{asset('assets/css/wysihtml5/prettify.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/wysihtml5/bootstrap-wysihtml5.css')}}">
  <link href="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{asset('assets/css/colorbox.css')}}">
@stop

{{-- Scripts --}}
@section('scripts')
  <script src="{{asset('assets/js/wysihtml5/wysihtml5-0.3.0.js')}}"></script>
  <script src="{{asset('assets/js/wysihtml5/bootstrap-wysihtml5.js')}}"></script>
  <script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
  <script src="{{asset('assets/js/jquery.colorbox.js')}}"></script>
  <script src="{{asset('assets/js/prettify.js')}}"></script>

  <script type="text/javascript">
  $('.wysihtml5').wysihtml5();
  $(prettyPrint);
  </script>

@stop
