@extends('layouts.layout')

<?php $nav = ''; ?>

@section('title', '我的个人主页')

@section('body')
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center header-profile-background">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Hello，</h1>
                    <h1 class="display-2 text-white">@if (empty($profile->real_name)) {{ $user->nickname }} @else {{ $profile->real_name }} @endif</h1>
                    <p class="text-white mt-0 mb-5">这里是你的个人主页，为了让你的其他同事能在花名册更好的认识你，你可以在这里编辑你的账号信息以及个人信息。</p>
                </div>
            </div>
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
                                    <img src="{{ asset('images/avatars/avatar.png') }}" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('my_password_change') }}" class="btn btn-sm btn-info mr-4">密码修改</a>
                            <a href="#" class="btn btn-sm btn-default float-right">上传头像</a>
                        </div>
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
                                <i class="ni location_pin mr-2"></i>管理员
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{ empty($profile->job) ? '赶紧填上你的岗位吧~' : $profile->job}}
                            </div>
                            <hr class="my-4" />
                            <p>{{ empty($profile->about) ? '你还没有向大家介绍你自己!' : $profile->about }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">我的主页</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="my-profile-form" action="{{ route('my_homepage') }}" method="post">
                            @csrf
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
                                            <label class="form-control-label">角色</label>
                                            <div>管理员</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="mobile">手机号</label>
                                            <input type="text" id="mobile" class="form-control form-control-alternative" data-url="{{ route('user_mobile_check') }}" name="mobile" value="{{ $user->verified_mobile ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">邮箱</label>
                                            <input type="text" id="email" class="form-control form-control-alternative" data-url="{{ route('user_email_check') }}" name="email" value="{{ $user->email ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">个人信息</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="real_name">真实姓名</label>
                                            <input type="text" id="real_name" class="form-control form-control-alternative" name="real_name" value="{{ $profile->real_name ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="age">年龄</label>
                                            <input type="number" id="age" class="form-control form-control-alternative" name="age" value="{{ $profile->age ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div>
                                                <label class="form-control-label" for="gender">性别</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                                <input name="gender" class="custom-control-input" id="gender[0]" type="radio" value="male" @if($profile->gender == 'male') checked @endif>
                                                <label class="custom-control-label" for="gender[0]">男</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                                <input name="gender" class="custom-control-input" id="gender[1]" type="radio" value="female" @if($profile->gender == 'female') checked @endif>
                                                <label class="custom-control-label" for="gender[1]">女</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                                <input name="gender" class="custom-control-input" id="gender[2]" type="radio" value="secret" @if($profile->gender == 'secret') checked @endif>
                                                <label class="custom-control-label" for="gender[2]">保密</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label class="form-control-label" for="address">现居地址</label>
                                            <input id="address" class="form-control form-control-alternative" name="address" value="{{ $profile->address ?? '' }}" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="graduation">毕业院校</label>
                                            <input id="graduation" class="form-control form-control-alternative" name="graduation" value="{{ $profile->graduation ?? '' }}" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="birthday">生日</label>
                                            <input type="text" id="birthday" class="form-control form-control-alternative" name="birthday" value="{{ $profile->birthday ?? '' }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="qq">QQ</label>
                                            <input type="text" id="qq" class="form-control form-control-alternative" name="qq" value="{{ $profile->qq ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="wechat">微信号</label>
                                            <input type="text" id="wechat" class="form-control form-control-alternative" name="wechat" value="{{ $profile->wechat ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="job">岗位</label>
                                            <input type="text" id="job" class="form-control form-control-alternative" name="job" value="{{ $profile->job ?? '' }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <!-- Description -->
                            <h6 class="heading-small text-muted mb-4">About Me</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label>关于我</label>
                                    <textarea rows="4" class="form-control form-control-alternative" name="about" placeholder="用一些话介绍你自己吧...">{{ $profile->about ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" id="save-btn">保存</button>
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
    <script src="{{ mix('js/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ mix('js/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ mix('js/my/homepage/index.js') }}"></script>
@endsection

