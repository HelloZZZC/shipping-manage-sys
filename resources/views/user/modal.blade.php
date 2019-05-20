@extends('layouts.modal')

@section('title', '新增用户')

@section('body')
    <form id="create-user-form" method="post" action="{{ route('user_create') }}">
        @csrf
        <div class="form-group row">
            <label for="nickname" class="col-sm-3 col-form-label">账号</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nickname" name="nickname" data-url="{{ route('user_nickname_check') }}" placeholder="请输入账号">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">邮箱</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="email" name="email" data-url="{{ route('user_email_check') }}" placeholder="请输入邮箱">
            </div>
        </div>
        <div class="form-group row">
            <label for="mobile" class="col-sm-3 col-form-label">手机号</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="mobile" name="mobile" data-url="{{ route('user_mobile_check') }}" placeholder="请输入手机号">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">密码</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码">
            </div>
        </div>
        <div class="form-group row">
            <label for="confirm-password" class="col-sm-3 col-form-label">确认密码</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="请再次输入密码">
            </div>
        </div>
    </form>
    <script src="{{ mix('js/libs/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ mix('js/user/create/index.js') }}"></script>
@endsection

@section('footer')
    <div class="js-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="save-btn">保存</button>
    </div>
@endsection
