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
                    <a href="{{ url('/mob/inventory') }}" key="t-saas"><i class="bx bx-file"></i>
                        <span key="t-dashboards">@lang('translation.Inventory')</span></a>
                    <a href="{{ url('/mob/customer') }}" key="t-saas"><i class="bx bxs-user-detail"></i>
                        <span key="t-dashboards">@lang('translation.Customer')</span></a>
                    <a href="{{ url('/mob/sale_report') }}" key="t-crypto"><i class="bx bx-tone"></i>
                        <span key="t-dashboards">@lang('translation.SaleReports')</span></a>
                    <a href="{{ url('/mob/profile') }}" key="t-blog"><i class="bx bx-user-circle"></i>
                        <span key="t-dashboards">@lang('translation.Profile')</span></a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
