@extends('layouts.modal')

@section('title', '修改用户密码')

@section('body')
    <form id="password-change-form" action="{{ route('user_password_change', ['id' => $user->id]) }}" method="post">
        @csrf
        <div class="form-group row">
            <label for="new_password" class="col-md-3 col-sm-2 col-form-label">新密码</label>
            <div class="col-md-6 col-sm-10">
                <input type="password" class="form-control" id="new_password" placeholder="请输入新密码" name="new_password">
            </div>
        </div>
        <div class="form-group row">
            <label for="confirm_password" class="col-md-3 col-sm-2 col-form-label">确认密码</label>
            <div class="col-md-6 col-sm-10">
                <input type="password" class="form-control" id="confirm_password" placeholder="请再次输入密码" name="confirm_password">
            </div>
        </div>
    </form>
    <script src="{{ mix('js/libs/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ mix('js/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ mix('js/user/change-password/index.js') }}"></script>
@endsection

@section('footer')
    <div class="js-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="submit-btn">确定</button>
    </div>
@endsection
