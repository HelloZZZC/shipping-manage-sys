@extends('layouts.layout')

@section('title', '数据导入')

@section('body')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ $info['name'] }}数据导入</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning" role="alert">
                            若重新上传文件将会<strong>清空</strong>数据库前一次上传Excel的数据,<strong>请谨慎操作!</strong>
                        </div>
                        <div class="text-center mt-5">
                            <button type="button" class="btn btn-primary btn-lg" id="import-btn" data-url="{{ route('importer_show', ['type' => $type]) }}">
                                <span class="btn-inner--icon"><i class="ni ni-cloud-upload-96"></i></span>
                                <span class="btn-inner--text">导入Excel</span>
                            </button>
                        </div>
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
    <script src="{{ mix('js/import/index.js') }}"></script>
@endsection
