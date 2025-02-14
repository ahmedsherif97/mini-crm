@canany(['create user', 'list user'])
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div class="text-truncate">{{ __('user::dashboard.users') }}</div>
        </a>
        <ul class="menu-sub">
            @can('create user')
                <li class="menu-item">
                    <a href="{{ route('dashboard.user.create') }}" class="menu-link">
                        <div class="text-truncate">{{ __('user::dashboard.create') }} {{ __('user::dashboard.user') }}</div>
                    </a>
                </li>
            @endcan
            @can('list user')
                <li class="menu-item">
                    <a href="{{ route('dashboard.user.index') }}" class="menu-link">
                        <div class="text-truncate">{{ __('user::dashboard.list') }} {{ __('user::dashboard.users') }}</div>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
