@extends('layouts.layout')

<?php $nav = 'setting'; ?>

@section('title', '物流设置')

@section('body')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">物流设置</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::has('shipping_setting.saved'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-inner--text">{{ Session::get('shipping_setting.saved') }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form id="shipping-setting-form" method="POST" action="{{ route('shipping_setting') }}">
                            @csrf
                            @foreach($setting as $single)
                                <div class="form-group row">
                                    <label class="col-md-2 col-sm-2 col-form-label">{{ $single['country_cn'] }}</label>
                                    <div class="col-md-8 col-sm-4 custom-control custom-control-alternative custom-checkbox form-check-inline">
                                        <div class="ml-20">
                                            <input class="custom-control-input" id="e-mail-{{ $single['country_id'] }}" type="checkbox" value="1" name="setting[{{ $single['country_id'] }}][0]" @if($single['shipping'][0] ?? false) checked @endif>
                                            <label class="custom-control-label" for="e-mail-{{ $single['country_id'] }}">E邮宝</label>
                                        </div>
                                        <div class="ml-20">
                                            <input class="custom-control-input" id="china-post-{{ $single['country_id'] }}" type="checkbox" value="1" name="setting[{{ $single['country_id'] }}][1]" @if($single['shipping'][1] ?? false) checked @endif>
                                            <label class="custom-control-label" for="china-post-{{ $single['country_id'] }}">中国邮政挂号小包</label>
                                        </div>
                                        <div class="ml-20">
                                            <input class="custom-control-input" id="ali-standard-{{ $single['country_id'] }}" type="checkbox" value="1" name="setting[{{ $single['country_id'] }}][2]" @if($single['shipping'][2] ?? false) checked @endif>
                                            <label class="custom-control-label" for="ali-standard-{{ $single['country_id'] }}">AliExpress无忧物流—标准</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-group row">
                                <div class="col-md-4 offset-md-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="submit-btn">保存</button>
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

