@can('list settings')
    <li class="menu-item">
        <a href="{{ route('dashboard.setting.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cog"></i>
            <div class="text-truncate">{{ __('setting::dashboard.settings') }}</div>
        </a>
    </li>
@endcan
