@if(auth()->user()->can('user.view') || auth()->user()->can('roles.view') || auth()->user()->can('sections.view'))
    <div data-kt-menu-trigger="click" class="menu-item here {{ request()->routeIs('settings.*') ? 'show' : '' }} menu-accordion">
        <span class="menu-link">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-5">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="currentColor" />
                        <path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="currentColor" />
                    </svg>
                </span>
            </span>
            <span class="menu-title">Settings</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion">
            @can('user.view')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('settings.users.*') ? 'active' : '' }}" href="{{ route('settings.users.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Users</span>
                    </a>
                </div>
            @endcan
            @can('roles.view')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('settings.roles.*') ? 'active' : '' }}" href="{{ route('settings.roles.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Roles</span>
                    </a>
                </div>
            @endcan
            @can('sections.view')
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('settings.sections.*') ? 'active' : '' }}" href="{{ route('settings.sections.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Sections</span>
                    </a>
                </div>
            @endcan
        </div>
    </div>
@endif
