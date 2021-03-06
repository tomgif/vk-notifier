<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ secure_asset('ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('ample/css/animate.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('ample/css/style.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('ample/css/colors/default.css') }}" id="theme" rel="stylesheet">

@stack('head')

    <!--[if lt IE 9]>
    <script src="{{ secure_asset('ample/js/html5shiv.js') }}"></script>
    <script src="{{ secure_asset('ample/js/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body class="fix-header show-sidebar hide-sidebar">
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>

<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <a class="logo" href="{{ secure_url('/') }}">
                    <b>
                        <img src="{{ secure_asset('ample/images/logo.png') }}" alt="home" class="light-logo"/>
                    </b>

                    <span class="hidden-xs">
                        <img src="https://via.placeholder.com/139x24/000000/FFFFFF" alt="home" class="light-logo"/>
                    </span>
                </a>
            </div>

            <ul class="nav navbar-top-links navbar-right pull-right">
                <li>
                    @if (Route::has('login'))
                        <a class="profile-pic" href="{{ route('login') }}">
                            <b class="hidden-xs">
                                {{ __('Login') }}
                            </b>
                        </a>
                    @endif
                </li>

                <li>
                    @if (Route::has('register'))
                        <a class="profile-pic" href="{{ route('register') }}">
                            <b class="hidden-xs">
                                {{ __('Register') }}
                            </b>
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    @yield('title', env('APP_NAME'))
                </div>
            </div>

            @yield('content')
        </div>
    </div>
</div>

<script src="{{ secure_asset('ample/plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ secure_asset('ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ secure_asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
<script src="{{ secure_asset('ample/js/jquery.slimscroll.js') }}"></script>
<script src="{{ secure_asset('ample/js/waves.js') }}"></script>
<script src="{{ secure_asset('ample/plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>

<script src="{{ secure_asset('ample/js/custom.min.js') }}"></script>
</body>
</html>
