<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
  <head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8" />
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
      @section('title')
      Laravel 4 Sample Site
      @show
    </title>
    @section('meta_keywords')
    <meta name="keywords" content="rcp" />
    @show
    @section('meta_author')
    <meta name="author" content="Jon Doe" />
    @show
    <!-- Google will often use this as its description of your page/sitei -->
    @section('meta_description')
    <meta name="description" content="Rcp" />
    @show

    <!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
    <meta name="google-site-verification" content="">

    <!-- Dublin Core Metadata : http://dublincore.org/ -->
    <meta name="DC.title" content="Project Name">
    <meta name="DC.subject" content="@yield('description')">
    <meta name="DC.creator" content="@yield('author')">

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <style>
        body {
          padding: 60px 0;
        }
        .scrollable-dropdown {
          height: auto;
          max-height: 200px;
          overflow-y: auto;
        }
    </style>
    @section('styles')
    @show

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicons
    ================================================== -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
    <link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
    <link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">

  </head>

  <body>
  <!-- To make sticky footer need to wrap in a div -->
    <div id="wrap">
      <!-- Navbar -->
      <div class="navbar navbar-default navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}"><span class="glyphicon glyphicon-home"></span> {{ Lang::get('general.home') }}</a></li>
              @if (Auth::check())
                @if (Auth::user()->hasRole('admin'))
                  <li {{ (Request::is('admin') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin') }}}"><span class="glyphicon glyphicon-lock"></span> {{ Lang::get('general.admin_panel') }}</a></li>
                @endif
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('affairs manager'))
                  <li class="dropdown{{{ (Request::is('admin/affairs*') ? ' active' : '') }}}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/categories/translate') }}}">
                      <span class="glyphicon glyphicon-file"></span> {{ Lang::get('general.affair') }}<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('affairs manager'))
                        <li{{ (Request::is('admin/affairs/manage*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/affairs/manage') }}}"><span class="glyphicon glyphicon-file"></span> {{ Lang::get('general.affair_management') }}</a></li>
                      @endif
                      @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('affairs translator'))
                        <li{{ (Request::is('admin/affairs/translate*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/affairs/translate') }}}"><span class="glyphicon glyphicon-file"></span> {{ Lang::get('general.affair_translation') }}</a></li>
                      @endif
                    </ul>
                  </li>
                @endif
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('categories manager') || Auth::user()->hasRole('categories translator'))
                  <li class="dropdown{{{ (Request::is('admin/categories*') ? ' active' : '') }}}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/categories/translation') }}}">
                      <span class="glyphicon glyphicon-th-list"></span> {{ Lang::get('general.categories') }}<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('categories manager'))
                        <li{{ (Request::is('admin/categories/manage/tree') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/categories/manage/tree') }}}">{{ Lang::get('general.categories_tree') }}</a></li>
                      @endif
                      @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('categories manager') || Auth::user()->hasRole('categories translator'))
                        <li{{ (Request::is('admin/categories/translation') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/categories/translation') }}}">{{ Lang::get('general.categories_translation') }}</a></li>
                      @endif
                    </ul>
                  </li>
                @endif
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('users manager'))
                  <li class="dropdown{{ (Request::is('admin/users*', 'admin/roles*') ? ' active' : '') }}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/users') }}}">
                      <span class="glyphicon glyphicon-user"></span> {{ Lang::get('general.users') }}<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('users manager'))
                      <li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/users') }}}"><span class="glyphicon glyphicon-user"></span> {{ Lang::get('general.users') }} </a></li>
                      @endif
                      <li{{ (Request::is('admin/roles*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/roles') }}}"><span class="glyphicon glyphicon-user"></span> {{ Lang::get('general.roles') }} </a></li>
                    </ul>
                  </li>
                @endif
              @endif
            </ul>

            <ul class="nav navbar-nav pull-right">
              @if (Auth::check())
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="glyphicon glyphicon-user"></span> {{{ Auth::user()->username }}}	<span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="{{{ URL::to('user/settings') }}}"><span class="glyphicon glyphicon-wrench"></span>{{ Lang::get('general.settings') }}</a></li>
                    <li class="divider"></li>
                    <li><a href="{{{ URL::to('user/logout') }}}"><span class="glyphicon glyphicon-share"></span>{{ Lang::get('general.logout') }}</a></li>
                  </ul>
                </li>
              @else
                <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">{{ Lang::get('general.login') }}</a></li>
              @endif
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ App::getLocale() }}<span class="caret"></span></a>
                <ul class="dropdown-menu scrollable-dropdown" role="menu">
                  @foreach( Config::get('constants.langs') as $key => $value )
                    <li>{{ link_to_route('language.select', $key, [$key]) }}</li>
                  @endforeach
                </ul>
              </li>
            </ul>
            <!-- ./ nav-collapse -->
          </div>
        </div>
      </div>
      <!-- ./ navbar -->

    <!-- Container -->
    <div class="container">
    <!-- Notifications -->
    @include('notifications')
    <!-- ./ notifications -->

    <!-- Content -->
    @yield('content')
    <!-- ./ content -->
  </div>
  <!-- ./ container -->

  <!-- the following div is needed to make a sticky footer -->
  <div id="push"></div>
  </div>
  <!-- ./wrap -->


  <div id="footer">
    <div class="container">
    @section('footer')
    <!--          <p class="muted credit">Laravel 4 Starter Site on <a href="https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site">Github</a>.</p>-->
    @show
    </div>
  </div>

    <!-- Javascripts
    ================================================== -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

  @yield('scripts')
  </body>
</html>
