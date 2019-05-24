@extends('layouts.modal')

@section('title', '头像裁剪')

@section('body')
    <form id="crop-form" method="post" action="{{ route('user_avatar_crop') }}">
        @csrf
        <div>
            <img src="{{ asset('storage/'.$avatar_url) }}" class="img-fluid img-center" id="crop_avatar" alt="">
        </div>
        <input type="text" name="tmp_avatar" value="{{ $avatar_url }}" hidden>
    </form>
    <script src="{{ mix('js/libs/cropperjs/cropper.min.js') }}"></script>
    <script src="{{ mix('js/libs/jquery-cropper/jquery-cropper.min.js') }}"></script>
    <script src="{{ mix('js/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ mix('js/user/crop-avatar/index.js') }}"></script>
@endsection

@section('footer')
    <div class="js-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="crop-btn">确定</button>
    </div>
@endsection
