@can('list activities')
    <li class="menu-item">
        <a href="{{ route('dashboard.activity.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cog"></i>
            <div class="text-truncate">{{ __('activity::dashboard.activities') }}</div>
        </a>
    </li>
@endcan
