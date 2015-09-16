@extends('site.layouts.default')

{{-- Title --}}
@section('title')
  Administration
@stop

{{-- Style --}}
@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/wysihtml5/css/prettify.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/wysihtml5/css/bootstrap-wysihtml5.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/colorbox/css/colorbox.css') }}">
@stop

{{-- Scripts --}}
@section('scripts')
  <script src="{{ asset('assets/wysihtml5/js/wysihtml5-0.3.0.js') }}"></script>
  <script src="{{ asset('assets/wysihtml5/js/bootstrap-wysihtml5.js') }}"></script>
  <script src="{{ asset('assets/datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/js/dataTables.bootstrap.js') }}"></script>
  <script src="{{ asset('assets/colorbox/js/jquery.colorbox.js') }}"></script>
  <script src="{{ asset('assets/colorbox/js/prettify.js') }}"></script>

  <script type="text/javascript">
  $('.wysihtml5').wysihtml5();
  $(prettyPrint);
  </script>

@stop
