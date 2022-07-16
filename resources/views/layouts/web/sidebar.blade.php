<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('translation.Menu')</li>
                <li>
                    <a href="{{ url('/') }}" key="t-default"><i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">@lang('translation.Dashboards')</span></a>
                    <a href="{{ url('/web/branch/inventory') }}" key="t-saas"><i class="bx bx-hive"></i>
                        <span key="t-dashboards">@lang('translation.BranchInventory')</span></a>
                    <a href="{{ url('/web/shop') }}" key="t-saas"><i class="bx bx-shopping-bag"></i>
                        <span key="t-dashboards">@lang('translation.Shop')</span></a>
                    <a href="{{ url('/web/branch') }}" key="t-crypto"><i class="bx bx-tone"></i>
                        <span key="t-dashboards">@lang('translation.Branch')</span></a>
                    <a href="{{ url('/web/report') }}" key="t-crypto"><i class="bx bxs-report"></i>
                        <span key="t-dashboards">@lang('translation.Report')</span></a>
                    <a href="{{ url('/web/inventory') }}" key="t-saas"><i class="bx bx-file"></i>
                        <span key="t-dashboards">@lang('translation.AuditInventory')</span></a>
                    <a href="{{ url('/web/user') }}" key="t-blog"><i class="bx bx-user-circle"></i>
                        <span key="t-dashboards">@lang('translation.User')</span></a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
