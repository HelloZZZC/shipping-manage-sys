@extends('layouts.layout')

<?php $nav = ''; ?>

@section('title', '密码修改')

@section('body')
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center header-profile-background">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Hello，@if (empty($profile->real_name)) {{ $user->nickname }} @else {{ $profile->real_name }} @endif</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">密码修改</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="password-change-form" action="{{ route('my_password_change') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="old_password" class="col-md-2 col-sm-2 col-form-label">当前密码</label>
                                <div class="col-md-4 col-sm-10">
                                    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="请输入旧密码" data-url="{{ route('my_password_check') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_password" class="col-md-2 col-sm-2 col-form-label">新密码</label>
                                <div class="col-md-4 col-sm-10">
                                    <input type="password" class="form-control" id="new_password" placeholder="请输入新密码" name="new_password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirm_password" class="col-md-2 col-sm-2 col-form-label">确认密码</label>
                                <div class="col-md-4 col-sm-10">
                                    <input type="password" class="form-control" id="confirm_password" placeholder="请再次输入密码" name="confirm_password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4 offset-md-2 col-sm-10">
                                    <button type="button" class="btn btn-primary" id="submit-btn">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footer')
    </div>
@endsection

@section('script')
    @parent
    <script src="{{ mix('js/libs/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ mix('js/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ mix('js/my/change-password/index.js') }}"></script>
@endsection


