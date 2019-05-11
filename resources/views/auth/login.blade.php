@extends('layouts.layout')

@section('title', '登录')

@section('sidenav')
@endsection

@section('topnavbar')
@endsection

@section('bodyclass', 'bg-default')

@section('body')
    <!-- Header -->
    <div class="header bg-gradient-primary py-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">Welcome!</h1>
                        <p class="text-lead text-light">ShippingMS是一个简单的物流计算管理系统，目的是为你的工作提供便利</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        @error('nickname')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text">{{ $message }}</span>
                            </div>
                        @enderror
                        <form role="form" method="POST" action="{{ route('login') }}" id="login-form" novalidate>
                            @csrf
                            <div class="form-group mb-4">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="账号" type="text" name="nickname" value="{{ old('nickname') }}" autocomplete="nickname">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="密码" type="password" name="password" autocomplete="current-password">
                                </div>
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">
                                    <span class="text-muted">记住密码</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4" id="login-btn">登录</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@parent
<script src="{{ mix('js/libs/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ mix('js/login/index.js') }}"></script>
@endsection
