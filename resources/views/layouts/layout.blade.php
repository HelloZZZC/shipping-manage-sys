<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="A Simple Shipping Manage System">
        <meta name="author" content="HelloZZZZC">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ShippingMS - @yield('title')</title>
        <!-- Favicon -->
        {{--<link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">--}}
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Main CSS -->
        @section('css')
            <link href="{{ mix('vendor/nucleo/css/main.css') }}" rel="stylesheet">
            <link href="{{ mix('vendor/fontawesome-free/css/main.css') }}" rel="stylesheet">
            <link type="text/css" href="{{ mix('css/main.css') }}" rel="stylesheet">
        @show
    </head>
    <body class="@yield('bodyclass')">
    @section('sidenav')
        <!-- Sidenav -->
        <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand pt-0" href="{{ route('homepage') }}">
                    <img src="{{ asset('images/blue.png') }}" class="navbar-brand-img" alt="...">
                </a>
                <!-- User -->
                <ul class="nav align-items-center d-md-none">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                      <span class="avatar avatar-sm rounded-circle">
                        <img alt="avatar" src="@if(!empty(Auth::user()->avatar)) {{ asset('storage/'.Auth::user()->avatar) }} @else {{ asset('images/avatars/avatar.png') }} @endif">
                      </span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <a href="{{ route('my_homepage') }}" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>我的简介</span>
                            </a>
                            <a href="{{ route('my_password_change') }}" class="dropdown-item">
                                <i class="ni ni-settings-gear-65"></i>
                                <span>密码修改</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:" class="dropdown-item js-logout">
                                <form class="js-logout-form" action="{{ route('logout') }}" method="post" hidden>@csrf</form>
                                <i class="ni ni-user-run"></i>
                                <span>退出登录</span>
                            </a>
                        </div>
                    </li>
                </ul>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Collapse header -->
                    <div class="navbar-collapse-header d-md-none">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="{{ route('homepage') }}">
                                    <img src="{{ asset('images/blue.png') }}">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Navigation -->
                    @include('layouts.navbar')
                </div>
            </div>
        </nav>
    @show
    <!-- Main content -->
    <div class="main-content">
        @section('topnavbar')
            <!-- Top navbar -->
            <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
                <div class="container-fluid">
                    <!-- Brand -->
                    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('homepage') }}">首页</a>
                    <!-- User -->
                    <ul class="navbar-nav align-items-center d-none d-md-flex">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                      <img alt="avatar" src="@if(!empty(Auth::user()->avatar)) {{ asset('storage/'.Auth::user()->avatar) }} @else {{ asset('images/avatars/avatar.png') }} @endif">
                                    </span>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">@if(Auth::check()) {{ Auth::user()->nickname }} @else '尚未登录' @endif </span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>
                                <a href="{{ route('my_homepage') }}" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>我的简介</span>
                                </a>
                                <a href="{{ route('my_password_change') }}" class="dropdown-item">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>密码修改</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:" class="dropdown-item js-logout">
                                    <form class="js-logout-form" action="{{ route('logout') }}" method="post" hidden>@csrf</form>
                                    <i class="ni ni-user-run"></i>
                                    <span>退出登录</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        @show
        @section('body')
            <!-- Content Body -->
        @show
    </div>
    <div class="modal" id="modal" tabindex="-1" role="dialog">
    </div>
    <div class="modal" id="static-modal" tabindex="-1" role="dialog" data-backdrop="static">
    </div>
    <!-- Main JS -->
    @section('script')
        <script src="{{ mix('js/main.min.js') }}"></script>
        <script src="{{ mix('js/app/index.js') }}"></script>
    @show
    </body>
</html>
