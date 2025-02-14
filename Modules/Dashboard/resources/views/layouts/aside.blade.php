{{--<!-- You can edit your custom aside menu here -->--}}

{{--@foreach (app('modules')->list() as $module)--}}
{{--    @includeIf(strtolower($module) . '::dashboard.layouts.aside')--}}
{{--@endforeach--}}
@includeIf('setting::dashboard.layouts.aside')
@includeIf('role::dashboard.layouts.aside')
@can('list employee')
    <li class="menu-item">
        <a href="{{route('dashboard.employees.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div class="text-truncate">Employees</div>
        </a>
    </li>
@endcan
@can('list customer')
    <li class="menu-item">
        <a href="{{route('dashboard.customers.index')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div class="text-truncate">Customers</div>
        </a>
    </li>
@endcan
<li class="menu-item">
    <a href="{{route('auth.logout')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-log-out"></i>
        <div class="text-truncate">{{__('dashboard.logout')}}</div>
    </a>
</li>

