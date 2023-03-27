@if(auth()->user()->can('user.view') || auth()->user()->can('user.delete') || auth()->user()->can('user.update') || auth()->user()->can('user.reset.password') || auth()->user()->can('user.create'))
    <div data-kt-menu-trigger="click" class="menu-item here {{ request()->routeIs('admin.settings.*') ? 'show' : '' }} menu-accordion">
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
            @if(auth()->user()->can('user.view') || auth()->user()->can('user.delete') || auth()->user()->can('user.update') || auth()->user()->can('user.reset.password') || auth()->user()->can('user.create'))
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.settings.users.*') ? 'active' : '' }}" href="{{ route('admin.settings.users.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Users</span>
                    </a>
                </div>
            @endif
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.settings.roles.*') ? 'active' : '' }}" href="{{ route('admin.settings.roles.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Roles</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.settings.partners.*') ? 'active' : '' }}" href="{{ route('admin.settings.partners.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Partners</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.settings.branches.*') ? 'active' : '' }}" href="{{ route('admin.settings.branches.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Branches</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.settings.rent.type.index') ? 'active' : '' }}" href="{{ route('admin.settings.rent.type.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Rent Types</span>
                </a>
            </div>
            <div class="menu-item ">
                <a class="menu-link {{ request()->routeIs('admin.settings.vehicle.type.index') ? 'active' : '' }}" href="{{ route('admin.settings.vehicle.type.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Vehicles Types</span>
                </a>
            </div>
            <div class="menu-item ">
                <a class="menu-link {{ request()->routeIs('admin.settings.vehicle.status.index') ? 'active' : '' }}" href="{{ route('admin.settings.vehicle.status.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Vehicles Statuses</span>
                </a>
            </div>
            <div class="menu-item ">
                <a class="menu-link {{ request()->routeIs('admin.settings.vehicle-groups.*') ? 'active' : '' }}" href="{{ route('admin.settings.vehicle-groups.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Vehicles Groups</span>
                </a>
            </div>

            <div class="menu-item ">
                <a class="menu-link {{ request()->routeIs('admin.settings.vehicle-transmissions.*') ? 'active' : '' }}" href="{{ route('admin.settings.vehicle-transmissions.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Vehicles Transmissions</span>
                </a>
            </div>

            <div class="menu-item ">
                <a class="menu-link {{ request()->routeIs('admin.settings.fuel-types.*') ? 'active' : '' }}" href="{{ route('admin.settings.fuel-types.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Vehicles Fuel Type</span>
                </a>
            </div>

            <div class="menu-item ">
                <a class="menu-link {{ request()->routeIs('admin.settings.vehicle-body-types.*') ? 'active' : '' }}" href="{{ route('admin.settings.vehicle-body-types.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Vehicles Body Type</span>
                </a>
            </div>

            <div class="menu-item ">
                <a class="menu-link {{ request()->routeIs('admin.settings.vehicle-drives.*') ? 'active' : '' }}" href="{{ route('admin.settings.vehicle-drives.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Vehicles Drive</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.settings.business-settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.business-settings.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">Business Settings</span>
                </a>
            </div>
        </div>
    </div>
@endif
