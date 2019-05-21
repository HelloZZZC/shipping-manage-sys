@extends('layouts.layout')

<?php $nav = 'user'; ?>

@section('title', '员工')

@section('body')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">员工管理</h3>
                            <div class="col text-right">
                                <a href="javascript:" data-url="{{ route('user_create') }}" class="btn btn-sm btn-primary" id="create-user-btn">新增员工</a>
                                <a href="javascript:" data-url="{{ route('user_importer_show') }}" class="btn btn-sm btn-primary" id="import-user-btn">批量导入员工</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center table-dark">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">账号</th>
                                    <th scope="col">邮箱</th>
                                    <th scope="col">手机号</th>
                                    <th scope="col">状态</th>
                                    <th scope="col">创建时间</th>
                                    <th scope="col">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!empty($users))
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->nickname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->verified_mobile }}</td>
                                            <td>@if(!empty($user->deleted_at)) 离职 @else 在职 @endif</td>
                                            <td>{{ $user->created_at }}</td>
                                            <th>这里是操作</th>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="20">
                                            <div class="empty">暂未查找到任何相关员工信息</div>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $users->links() }}
                        </nav>
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
    <script src="{{ mix('js/user/index.js') }}"></script>
@endsection
