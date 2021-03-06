@extends('layouts.layout')

<?php $nav = 'setting'; ?>

@section('title', '系统设置')

@section('body')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">系统设置</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::has('system_setting.saved'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text">{{ Session::get('system_setting.saved') }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form id="system-setting-form" method="POST" action="{{ route('system_setting') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="exchange_rate" class="col-md-2 col-sm-2 col-form-label">汇率</label>
                                <div class="col-md-4 col-sm-10">
                                    <input type="text" class="form-control" id="exchange_rate" name="exchange_rate" placeholder="汇率" value="{{ $setting['exchange_rate'] ?? ''
                                     }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="commission" class="col-md-2 col-sm-2 col-form-label">佣金(%)</label>
                                <div class="col-md-4 col-sm-10">
                                    <input type="text" class="form-control" id="commission" placeholder="佣金" name="commission" value="{{ $setting['commission'] ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="e_mail_discount" class="col-md-2 col-sm-2 col-form-label">E邮宝物流折扣(%)</label>
                                <div class="col-md-4 col-sm-10">
                                    <input type="text" class="form-control" id="e_mail_discount" placeholder="E邮宝物流折扣" name="e_mail_discount" value="{{ $setting['e_mail_discount'] ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="china_post_discount" class="col-md-2 col-sm-2 col-form-label">挂号小包物流折扣(%)</label>
                                <div class="col-md-4 col-sm-10">
                                    <input type="text" class="form-control" id="china_post_discount" placeholder="挂号小包物流折扣" name="china_post_discount" value="{{ $setting['china_post_discount'] ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ali_standard_discount" class="col-md-2 col-sm-2 col-form-label">无忧标准物流折扣(%)</label>
                                <div class="col-md-4 col-sm-10">
                                    <input type="text" class="form-control" id="ali_standard_discount" placeholder="无忧标准物流折扣" name="ali_standard_discount" value="{{ $setting['ali_standard_discount'] ?? ''}}">
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
    <script src="{{ mix('js/setting/system/index.js') }}"></script>
@endsection

