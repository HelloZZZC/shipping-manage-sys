@extends('layouts.modal')

@section('title', '设置角色')

@section('body')
    <form id="role-change-form" action="{{ route('user_role_change', ['id' => $user->id]) }}" method="post">
        @csrf
        <div class="form-group row">
            <label for="new_password" class="col-md-2 col-sm-2 col-form-label">角色</label>
            <div class="col-md-10 col-sm-10">
                @foreach($roles as $role)
                    @if($role->name != 'superAdmin' || Auth::user()->hasRole('superAdmin'))
                        <div class="custom-control custom-radio custom-control-inline role-radio">
                            <input class="custom-control-input" name="role" type="radio"  id="role[{{ $role->name }}]" value="{{ $role->name }}" @if($role->name == $current_role) checked @endif>
                            <label class="custom-control-label" for="role[{{ $role->name }}]">{{ $map[$role->name] }}</label>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </form>
    <script src="{{ mix('js/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ mix('js/user/change-role/index.js') }}"></script>
@endsection

@section('footer')
    <div class="js-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="submit-btn">确定</button>
    </div>
@endsection
