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
        <li class="nav-header">Main Menu</li>

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
                <i class="nav-icon far fa  fa-building"></i>
                <p>
                    Companies
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('view_companies')}}" class="nav-link @if(Route::is('view_companies')) active @endif">
                        <i class="nav-icon far fa fa-list-ul"></i>
                        <p>Companies List</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('create_company')}}" class="nav-link @if(Route::is('create_company')) active @endif">
                        <i class="nav-icon far fa fa-plus-circle"></i>
                        <p>Add Company</p>
                    </a>
                </li>

            </ul>
        </li>


        <li class="nav-item has-treeview @if(Route::is('view_stations')) menu-open @endif">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa   fa-map-pin"></i>
                <p>
                    Stations
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('view_stations')}}" class="nav-link @if(Route::is('view_stations')) active @endif">
                        <i class="nav-icon far fa fa-list-ul"></i>
                        <p>Stations List</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('create_station')}}" class="nav-link @if(Route::is('create_station')) active @endif">
                        <i class="nav-icon far fa fa-plus-circle"></i>
                        <p>Add Station</p>
                    </a>
                </li>

            </ul>
        </li>


        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa fa-industry"></i>
                <p>
                    Manufacturers
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{route('view_vendors')}}" class="nav-link @if(Route::is('view_vendors')) active @endif">
                        <i class="nav-icon far fa fa-list-ul"></i>
                        <p>Manufacturers List</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('create_vendor')}}" class="nav-link @if(Route::is('create_vendor')) active @endif">
                        <i class="nav-icon far fa fa-plus-circle"></i>
                        <p>Add Manufacturer</p>
                    </a>
                </li>

            </ul>
        </li>


        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa  fa-tags"></i>
                <p>
                    Categories
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('view_categories')}}" class="nav-link @if(Route::is('view_categories')) active @endif">
                        <i class="nav-icon far fa fa-list-ul"></i>
                        <p>Categories List</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('create_category')}}" class="nav-link @if(Route::is('create_category')) active @endif">
                        <i class="nav-icon far fa fa-plus-circle"></i>
                        <p>Add Category</p>
                    </a>
                </li>
            </ul>
        </li>




        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa  fa-folder"></i>
                <p>
                    Assets
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('view_assets')}}" class="nav-link @if(Route::is('view_assets')) active @endif">
                        <i class="nav-icon far fa fa-list-ul"></i>
                        <p>Assets List</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('create_asset')}}" class="nav-link @if(Route::is('create_asset')) active @endif">
                        <i class="nav-icon far fa fa-plus-circle"></i>
                        <p>Add Asset</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa  fa-random"></i>
                <p>
                    Inventory
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{route('view_allocations')}}" class="nav-link @if(Route::is('view_allocations')) active @endif">
                        <i class="nav-icon far fa fa-list-ul"></i>
                        <p>Allocation List</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('allocate_assets')}}" class="nav-link @if(Route::is('allocate_assets')) active @endif">
                        <i class="nav-icon far fa  fa-arrow-right"></i>
                        <p>Allocate Asset</p>
                    </a>
                </li>

            </ul>
        </li>


        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa fa-cog"></i>
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
                    <a href="{{route('view-users')}}" class="nav-link @if(Route::is('view-users')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-header">Incidents</li>

        <li class="nav-item">
            <a href="{{route('my-profile')}}" class="nav-link @if(Route::is('my-profile')) active @endif">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    My Incidents
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('my-profile')}}" class="nav-link @if(Route::is('my-profile')) active @endif">
            <i class="nav-icon far fa fa-plus-circle"></i>
                <p>
                    Create Incident
                </p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa  fa-bookmark"></i>
                <p>
                    Reports
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{route('view_allocations')}}" class="nav-link @if(Route::is('view_allocations')) active @endif">
                        <i class="nav-icon far fa fa-list-ul"></i>
                        <p>Open incidents</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('view_allocations')}}" class="nav-link @if(Route::is('view_allocations')) active @endif">
                        <i class="nav-icon far fa fa-list-ul"></i>
                        <p>Closed incidents</p>
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


    </ul>
</nav>