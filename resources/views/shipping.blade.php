@extends('layouts.layout')

<?php $nav = 'shipping'; ?>

@section('title', '物流计算')

@section('body')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <?php $calcMode = empty(Request::offsetGet('calc_mode')) ? 'fixed_gross_margin' : Request::offsetGet('calc_mode') ?>
        <div class="row">
            <div class="col">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">价格计算器</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="price-calculate-form" method="GET" action="{{ route('shipping') }}" novalidate>
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label for="type">重量范围</label>
                                    <select class="form-control" id="type" name="price_basis_type" id="price_basis_type">
                                        <?php $select=['aliStandard' => '450克以上(含450克)', 'eMail' => '450克以下'] ?>
                                        <option value="">请选择重量范围</option>
                                        @foreach($select as $index => $single)
                                            <option value="{{ $index }}" {{ Request::offsetGet('price_basis_type') == $index ? 'selected' : '' }}>{{ $single }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="discount_rate">平台折扣率(%)</label>
                                    <input type="text" class="form-control" id="discount_rate" name="discount_rate" placeholder="请输入平台折扣率" value="{{ Request::offsetGet('discount_rate') ?? 39 }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="fixed_gross_margin">固定毛利率(%)</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input js-mode-radio" type="radio" name="calc_mode" value="fixed_gross_margin" @if ( $calcMode == 'fixed_gross_margin' ) checked @endif>
                                        <input type="text" class="form-control" id="fixed_gross_margin" name="fixed_gross_margin" placeholder="请输入固定毛利率" value="{{ Request::offsetGet('fixed_gross_margin') }}" @if ($calcMode != 'fixed_gross_margin' ) disabled @endif>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="price">售价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input js-mode-radio" type="radio" name="calc_mode" value="price" @if ($calcMode == 'price' ) checked @endif>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="请输入售价" value="{{ Request::offsetGet('price') }}" @if ($calcMode != 'price' ) disabled @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label for="weight">重量(g)</label>
                                    <input type="text" class="form-control" id="weight" name="weight" placeholder="请输入重量" value="{{ Request::offsetGet('weight') ?? '' }}">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="profit">产品成本(元)</label>
                                    <input type="text" class="form-control" id="profit" name="profit" placeholder="请输入产品成本" value="{{ Request::offsetGet('profit') ?? '' }}">
                                </div>
                            </div>
                            <button class="btn btn-primary mb-3" type="button" id="search-btn">计算价格</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table align-items-center table-dark">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">国家名称</th>
                                    <th scope="col">物流名称</th>
                                    <th scope="col">运费(¥)</th>
                                    <th scope="col">固定毛利率(%)</th>
                                    <th scope="col">售价($)</th>
                                    <th scope="col">平台售价($)</th>
                                    <th scope="col">毛利利润($)</th>
                                    <th scope="col">毛利利润(¥)</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($detail))
                                        @foreach($detail as $single)
                                            <tr>
                                                <td>{{ $single['country_cn'] }}</td>
                                                <td>{{ $single['shipping_name'] }}</td>
                                                <td>{{ $single['freight'] ?? '' }}</td>
                                                <td>{{ $single['fixed_gross_margin'] ?? '' }}</td>
                                                <td>{{ $single['price'] ?? '' }}</td>
                                                <td>{{ $single['platform_price'] ?? '' }}</td>
                                                <td>{{ $single['gross_profit'] ?? '' }}</td>
                                                <td>{{ $single['gross_profit_CNY'] ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="20">
                                                <div class="empty">请输入相关数据计算价格</div>
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

@section('script')
    @parent
    <script src="{{ mix('js/libs/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ mix('js/shipping/index.js') }}"></script>
@endsection
