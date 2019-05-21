@extends('layouts.modal')

@section('title', '导入Excel')

@section('body')
    <form id="import-form" method="post">
        @csrf
        <div class="js-form-container">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input class="form-control js-show-file" disabled>
                    <input type="file" class="js-file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="file" hidden>
                </div>
                <div class="form-group col-md-2">
                    <button type="button" class="btn btn-primary js-select-file">浏览</button>
                    <a href="javascript:" class="btn btn-link d-sm-none">下载示例文件</a>
                </div>
                <div class="form-group">
                    <a href="javascript:" class="btn btn-link d-none d-sm-block">下载示例文件</a>
                </div>
            </div>
            <div class="form-group">
                <span class="text-danger">请选择导入员工的excel文件</span>
            </div>
        </div>
        <div class="js-import-message text-danger mb-1"></div>
        <div class="progress" style="display:none;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>
    </form>
    <script src="{{ mix('js/libs/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ mix('js/user/import-file/index.js') }}"></script>
@endsection

@section('footer')
    <div class="js-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" id="save-btn" data-import-url="{{ route('user_import') }}">确定</button>
    </div>
@endsection

