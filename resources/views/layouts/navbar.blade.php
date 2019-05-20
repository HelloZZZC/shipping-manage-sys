<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('homepage') }}">
            <i class="ni ni-tv-2 text-primary"></i>首页
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user') }}">
            <i class="fas fa-users text-primary"></i>员工
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./examples/icons.html">
            <i class="ni ni-single-02 text-primary"></i>角色
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="./examples/maps.html">
            <i class="ni ni-badge text-primary"></i>花名册
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
            <i class="ni ni-box-2 text-primary"></i>
            <span class="nav-link-text text-primary">导入数据</span>
        </a>

        <div class="collapse hide" id="navbar-examples">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('importer', ['type' => 'chinaPost']) }}">
                        中国邮政挂号小包
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('importer', ['type' => 'aliStandard']) }}">
                        AliExpress无忧物流（标准）
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('importer', ['type' => 'eMail']) }}">
                        e邮宝
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('shipping') }}">
            <i class="ni ni-laptop text-primary"></i>价格计算器
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="#navbar-settings" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-settings">
            <i class="ni ni-settings-gear-65 text-primary"></i>
            <span class="nav-link-text text-primary">设置</span>
        </a>

        <div class="collapse hide" id="navbar-settings">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('system_setting') }}">
                        系统设置
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shipping_setting') }}">
                        物流设置
                    </a>
                </li>
            </ul>
        </div>
    </li>
</ul>
