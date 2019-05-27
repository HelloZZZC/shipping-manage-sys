<ul class="navbar-nav">
    @can('viewHomepage')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('homepage') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text @if ($nav == 'homepage') text-primary @endif">首页</span>
            </a>
        </li>
    @endcan

    @can('viewUser')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user') }}">
                <i class="fas fa-users text-primary"></i>
                <span class="nav-link-text @if ($nav == 'user') text-primary @endif">员工</span>
            </a>
        </li>
    @endcan

    @can('viewRole')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('role') }}">
                <i class="ni ni-single-02 text-primary"></i>
                <span class="nav-link-text @if ($nav == 'role') text-primary @endif">角色</span>
            </a>
        </li>
    @endcan

    @can('viewRoster')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('roster') }}">
                <i class="ni ni-badge text-primary"></i>
                <span class="nav-link-text @if ($nav == 'roster') text-primary @endif">花名册</span>
            </a>
        </li>
    @endcan

    @can('viewImporter')
        <li class="nav-item">
            <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="ni ni-box-2 text-primary"></i>
                <span class="nav-link-text @if ($nav == 'shipping_import') text-primary @endif">导入数据</span>
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
    @endcan

    @can('viewShipping')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('shipping') }}">
                <i class="ni ni-laptop text-primary"></i>
                <span class="nav-link-text @if ($nav == 'shipping') text-primary @endif">价格计算器</span>
            </a>
        </li>
    @endcan

    @can('viewSetting')
        <li class="nav-item">
            <a class="nav-link" href="#navbar-settings" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-settings">
                <i class="ni ni-settings-gear-65 text-primary"></i>
                <span class="nav-link-text @if ($nav == 'setting') text-primary @endif">设置</span>
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
    @endcan
</ul>
