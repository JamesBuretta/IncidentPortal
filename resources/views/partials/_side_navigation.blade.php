<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
            <a href="{{route('admin_dashboard')}}" class="nav-link @if(Route::is('admin_dashboard')) active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-header">MENUS</li>
        @can('menu-access-control', 'profile')
            <li class="nav-item">
                <a href="{{route('my-profile')}}" class="nav-link @if(Route::is('my-profile')) active @endif">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        My Profile
                    </p>
                </a>
            </li>
        @endcan

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Settings
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('view_roles')}}" class="nav-link @if(Route::is('view_roles')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('view_stations')}}" class="nav-link @if(Route::is('view_stations')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Stations</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('view-users')}}" class="nav-link @if(Route::is('view-users')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>

            </ul>
        </li>

        @can('menu-access-control', 'profile')
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Incidents
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('create_incident')}}" class="nav-link @if(Route::is('create_incident')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Create Incident</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('view_incidents')}}" class="nav-link @if(Route::is('view_incidents')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View Incidents</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('reports')}}" class="nav-link @if(Route::is('reports')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Incidents Reports</p>
                    </a>
                </li>


            </ul>
        </li>
        @endcan


{{--        <li class="nav-item has-treeview">--}}
{{--            <a href="#" class="nav-link">--}}
{{--                <i class="nav-icon far fa-plus-square"></i>--}}
{{--                <p>--}}
{{--                    Assets--}}
{{--                    <i class="fas fa-angle-left right"></i>--}}
{{--                </p>--}}
{{--            </a>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('create_incident')}}" class="nav-link @if(Route::is('create_incident')) active @endif">--}}
{{--                        <i class="far fa-circle nav-icon"></i>--}}
{{--                        <p>Create Asset</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @can('menu-access-control', 'manage_licence')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('view_incidents')}}" class="nav-link @if(Route::is('view_incidents')) active @endif">--}}
{{--                            <i class="far fa-circle nav-icon"></i>--}}
{{--                            <p>Assets</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}



{{--            </ul>--}}
{{--        </li>--}}


{{--        <li class="nav-item has-treeview">--}}
{{--            <a href="#" class="nav-link">--}}
{{--                <i class="nav-icon far fa-plus-square"></i>--}}
{{--                <p>--}}
{{--                    Inventory--}}
{{--                    <i class="fas fa-angle-left right"></i>--}}
{{--                </p>--}}
{{--            </a>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('create_incident')}}" class="nav-link @if(Route::is('create_incident')) active @endif">--}}
{{--                        <i class="far fa-circle nav-icon"></i>--}}
{{--                        <p>Create Inventory</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @can('menu-access-control', 'manage_licence')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('view_incidents')}}" class="nav-link @if(Route::is('view_incidents')) active @endif">--}}
{{--                            <i class="far fa-circle nav-icon"></i>--}}
{{--                            <p>Inventory</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}



{{--            </ul>--}}
{{--        </li>--}}


    </ul>
</nav>
