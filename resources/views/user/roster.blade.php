@extends('layouts.layout')

<?php $nav = 'roster'; ?>

@section('title', '花名册')

@section('body')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">花名册</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="roster-form" method="GET" novalidate class="mb-4">
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label for="type">关键词类型</label>
                                    <select class="form-control" id="type" name="keyword_type" id="keyword_type">
                                        <?php $select=['nickname' => '账号', 'email' => '邮箱', 'verified_mobile' => '手机号'] ?>
                                        <option value="">请选择关键词类型</option>
                                        @foreach($select as $index => $single)
                                            <option value="{{ $index }}" {{ Request::offsetGet('keyword_type') == $index ? 'selected' : '' }}>{{ $single }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="keyword">关键词</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="keyword" name="keyword" value="{{ Request::offsetGet('keyword') }}" placeholder="请输入关键词">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" id="search-btn">搜索</button>
                        </form>
                        <div>
                            <div class="row">
                                @foreach($users as $user)
                                    <div class="col col-md-4 mb-4">
                                        <div class="card card-float">
                                            <img class="card-img-top" src="{{ asset('images/roster-cover.jpg') }}">
                                            <span class="avatar avatar-lg rounded-circle roster-card-img">
                                                <img src="{{ asset('images/avatars/avatar.png') }}" class="rounded-circle">
                                            </span>
                                            <div class="card-body">
                                                <h3 class="card-title text-center">
                                                    @if (empty($profiles[$user->id]['real_name'])) {{ $user->nickname }} @else {{ $profiles[$user->id]['real_name'] }} @endif<span class="font-weight-light">, @if ($profiles[$user->id]['gender'] == 'secret') 保密 @elseif ($profiles[$user->id]['gender'] == 'female') 女 @else 男 @endif</span>
                                                </h3>
                                                <div class="h5 font-weight-light text-center">
                                                    管理员
                                                </div>
                                                <h4 class="text-center">
                                                    {{ $profiles[$user->id]['job'] ?? '' }}
                                                </h4>
                                                <div class="text-center">
                                                    <a href="{{ route('user_homepage', ['id' => $user->id]) }}">Show more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $users->appends(request()->all())->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footer')
    </div>
@endsection
