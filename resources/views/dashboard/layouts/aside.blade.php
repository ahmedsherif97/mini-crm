<div class="layout-menu-toggle navbar-nav d-xl-none">
    <a class="nav-item nav-link" href="javascript:void(0)">
        <i class="bx bx-menu bx-md"></i>
    </a>
</div>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard.home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img class="img-fluid" style="width: 100px" src="{{ app('settings')->find('logo') }}" alt="">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">{{ app('settings')->find('name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <div class="d-flex align-items-center px-4">
    </div>
    <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('dashboard.main.navigation') }}</span>
        </li>
        <li class="menu-item">
            <a href="{{ route('dashboard.home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate">{{ __('dashboard.dashboard') }}</div>
            </a>
        </li>

        @includeIf('dashboard::layouts.aside')

    </ul>
</aside>
