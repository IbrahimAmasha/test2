<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">@lang('messages.main')</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.user.management') }}">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">@lang('messages.users')</span>
            </a>
        </li>

        @if (auth()->user()->hasPermission('manage_roles'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.role.management') }}">
                    <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                    <span class="menu-title">@lang('messages.roles')</span>
                </a>
            </li>
        @endif

        @if (auth()->user()->hasPermission('manage_permissions'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.permission.management') }}">
                    <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                    <span class="menu-title">@lang('messages.permissions')</span>
                </a>
            </li>
        @endif
    </ul>
</nav>
