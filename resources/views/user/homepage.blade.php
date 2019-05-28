@extends('layouts.layout')

<?php $nav = ''; ?>

@section('title', 'Ta的个人主页')

@section('body')
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center header-profile-background">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="@if(!empty($user->avatar)) {{ asset('storage/'.$user->avatar) }} @else {{ asset('images/avatars/avatar.png') }} @endif" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        {{--这里原先有内容，但因为没用被我删掉，但div保留是为了撑起元素--}}
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    {{--这里原先有内容，但因为没用被我删掉，但div保留是为了撑起元素--}}
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                @if (empty($profile->real_name)) {{ $user->nickname }} @else {{ $profile->real_name }} @endif<span class="font-weight-light">, @if ($profile->gender == 'secret') 保密 @elseif ($profile->gender == 'female') 女 @else 男 @endif</span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{ $role }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{ empty($profile->job) ? '资料尚未填写' : $profile->job}}
                            </div>
                            <hr class="my-4" />
                            <p>{{ empty($profile->about) ? '资料尚未填写' : $profile->about }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Ta的主页</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">账号信息</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">账号</label>
                                        <div>{{ $user->nickname }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">手机号</label>
                                        <div>{{ $user->verified_mobile }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">邮箱</label>
                                        <div>{{ $user->email }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <!-- Address -->
                        <h6 class="heading-small text-muted mb-4">Ta的信息</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">年龄</label>
                                        <div>{{ $profile->age ?? '资料尚未填写' }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">生日</label>
                                        <div>{{ empty($profile->birthday) ? '资料尚未填写' : $profile->birthday }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">现居地址</label>
                                        <div>{{ empty($profile->address) ? '资料尚未填写' : $profile->address }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">毕业院校</label>
                                        <div>{{ empty($profile->graduation) ? '资料尚未填写' : $profile->graduation }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">QQ</label>
                                        <div>{{ empty($profile->qq) ? '资料尚未填写' : $profile->qq}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">微信号</label>
                                        <div>{{ empty($profile->wechat) ? '资料尚未填写' : $profile->wechat }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footer')
    </div>
@endsection


