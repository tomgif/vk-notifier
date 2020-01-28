<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <link href="{{ asset('ample/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('ample/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('ample/css/colors/default.css') }}" id="theme" rel="stylesheet">

@stack('head')

    <!--[if lt IE 9]>
    <script src="{{ asset('ample/js/html5shiv.js') }}"></script>
    <script src="{{ asset('ample/js/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body class="fix-header">
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>

<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <a class="logo" href="{{ url('/') }}">
                    <b>
                        <img src="{{ asset('ample/images/logo.png') }}" alt="home" class="light-logo"/>
                    </b>

                    <span class="hidden-xs">
                        <img src="https://via.placeholder.com/140x25" alt="home" class="dark-logo"/>
                        <img src="https://via.placeholder.com/140x25/000000/FFFFFF" alt="home" class="light-logo"/>
                    </span>
                </a>
            </div>

            <ul class="nav navbar-top-links navbar-right pull-right">
                <li>
                    <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg" href="javascript:void(0)">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>

                <li>
                    @can('manage-users')
                    <a class="profile-pic" href="{{ route('admin.users.edit', Auth::user()->id) }}">
                        <img src="https://via.placeholder.com/128" alt="user-img" width="36" class="img-circle">

                        <b class="hidden-xs">
                            {{ Auth::user()->name }}
                        </b>
                    </a>
                    @else
                        <a class="profile-pic" href="javascript:void(0);">
                            <img src="https://via.placeholder.com/128" alt="user-img" width="36" class="img-circle">

                            <b class="hidden-xs">
                                {{ Auth::user()->name }}
                            </b>
                        </a>
                    @endcan
                </li>
            </ul>
        </div>
    </nav>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav slimscrollsidebar">
            <div class="sidebar-head">
                <h3>
                    <span class="fa-fw open-close">
                        <i class="ti-close ti-menu"></i>
                    </span>

                    <span class="hide-menu">
                        Меню
                    </span>
                </h3>
            </div>

            <ul class="nav" id="side-menu">
                <li style="padding: 70px 0 0;">
                    <a href="{{ route('admin.dashboard.index') }}" class="waves-effect">
                        <i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>
                        Панель управления
                    </a>
                </li>

                @can('manage-users')
                <li>
                    <a href="{{ route('admin.users.index') }}" class="waves-effect">
                        <i class="fa fa-users fa-fw" aria-hidden="true"></i>
                        Пользователи
                    </a>
                </li>
                @endcan

                @can('manage-subscriptions')
                <li>
                    <a href="{{ route('admin.subscriptions.index') }}" class="waves-effect">
                        <i class="fa fa-send fa-fw" aria-hidden="true"></i>
                        Подписки
                    </a>
                </li>
                @endcan

                <li>
                    <a href="javascript:void(0)" class="waves-effect" onclick="document.getElementById('logout').submit()">
                        <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>
                        Выход
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">
                        @yield('page-title')
                    </h4>
                </div>

                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('admin.dashboard.index') }}">Панель управления</a>
                        </li>
                        @stack('navigation')
                    </ol>
                </div>
            </div>

            @yield('content')
        </div>
    </div>
</div>

<form id="logout" action="{{ route('logout') }}" method="post" style="display: none;">
    @csrf
</form>

<script src="{{ asset('ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
<script src="{{ asset('ample/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('ample/js/waves.js') }}"></script>
<script src="{{ asset('ample/plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
<script src="{{ asset('ample/js/custom.min.js') }}"></script>

@stack('footer')
</body>
</html>
