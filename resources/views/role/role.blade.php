@extends('layouts.layout')

<?php $nav = 'role'; ?>

@section('title', '角色')

@section('body')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">角色管理</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center table-dark">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="20%">名称</th>
                                    <th scope="col">权限范围</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($count)
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $map[$role->name] }}</td>
                                            <td>
                                                @foreach($permissions[$role->name] as $permission)
                                                    <div class="custom-control custom-control-alternative custom-checkbox custom-control-inline">
                                                        <input class="custom-control-input" type="checkbox" checked disabled>
                                                        <label class="custom-control-label">{{ $permission }}</label>
                                                    </div>
                                                @endforeach
                                            </td>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="20">
                                            <div class="empty">系统尚未存在任何角色</div>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footer')
    </div>
@endsection
