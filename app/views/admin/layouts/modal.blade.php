<!DOCTYPE html>

<html lang="{{ App::getLocale() }}">

<head>

  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>
    @section('title')
      {{{ $title }}} :: Administration
    @show
  </title>

  <meta name="keywords" content="@yield('keywords')" />
  <meta name="author" content="@yield('author')" />
  <!-- Google will often use this as its description of your page/site. Make it good. -->
  <meta name="description" content="@yield('description')" />

  <!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
  <meta name="google-site-verification" content="">

  <!-- Dublin Core Metadata : http://dublincore.org/ -->
  <meta name="DC.title" content="Project Name">
  <meta name="DC.subject" content="@yield('description')">
  <meta name="DC.creator" content="@yield('author')">

  <!--  Mobile Viewport Fix -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- This is the traditional favicon.
   - size: 16x16 or 32x32
   - transparency is OK
   - see wikipedia for info on browser support -->
  <!--
  <link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
  -->

  <!-- iOS favicons. -->
  <!--
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
  <link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
  -->

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/wysihtml5/css/prettify.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/wysihtml5/css/bootstrap-wysihtml5.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/colorbox/css/colorbox.css') }}">

  <style>
  .tab-pane {
    padding-top: 20px;
  }
  </style>

  @yield('styles')

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- Asynchronous google analytics; this is the official snippet.
   Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-31122385-3']);
_gaq.push(['_trackPageview']);

(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

  </script> -->

</head>

<body>
  <!-- Container -->
  <div class="container">

    <!-- Notifications -->
    @include('notifications')
    <!-- ./ notifications -->

    <div class="page-header">
      <h3>
        {{ $title }}
        <div class="pull-right">
          <button class="btn btn-default btn-small btn-inverse close_popup"><span class="glyphicon glyphicon-circle-arrow-left"></span> {{ Lang::get('button.back') }}</button>
        </div>
      </h3>
    </div>

    <!-- Content -->
    @yield('content')
    <!-- ./ content -->

    <!-- Footer -->
    <footer class="clearfix">
      @yield('footer')
    </footer>
    <!-- ./ Footer -->

  </div>
  <!-- ./ container -->

  <!-- Javascripts -->
  <script src="{{ asset('assets/jquery/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/wysihtml5/js/wysihtml5-0.3.0.js') }}"></script>
  <script src="{{ asset('assets/wysihtml5/js/bootstrap-wysihtml5.js') }}"></script>
  <script src="{{ asset('assets/datatables/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/js/dataTables.bootstrap.js') }}"></script>
  <script src="{{ asset('assets/colorbox/js/jquery.colorbox.js') }}"></script>
  <script src="{{ asset('assets/colorbox/js/prettify.js') }}"></script>

<script type="text/javascript">
$(document).ready(function(){
  $('.close_popup').click(function(){
    parent.oTable.ajax.reload();
    parent.jQuery.fn.colorbox.close();
    return false;
  });
  $('#deleteForm').submit(function(event) {
    var form = $(this);
    $.ajax({
    type: form.attr('method'),
      url: form.attr('action'),
      data: form.serialize()
    }).done(function() {
      parent.jQuery.colorbox.close();
      parent.oTable.ajax.reload();
    }).fail(function() {
    });
    event.preventDefault();
  });
});
$('.wysihtml5').wysihtml5();
$(prettyPrint)
  </script>

    @yield('scripts')

</body>

</html>
