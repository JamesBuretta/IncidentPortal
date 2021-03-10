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
        @can('menu-access-control', 'view_business')
            <li class="nav-item">
                <a href="{{route('view-business')}}" class="nav-link @if(Route::is('view-business')) active @endif">
                    <i class="nav-icon fas fa-briefcase"></i>
                    <p>
                        Business List
                    </p>
                </a>
            </li>
        @endcan
        @can('menu-access-control', 'faq')
            <li class="nav-item">
                <a href="{{route('view_user_faq')}}" class="nav-link @if(Route::is('view_user_faq')) active @endif">
                    <i class="nav-icon fas fa-question-circle"></i>
                    <p>
                        FAQ
                    </p>
                </a>
            </li>
        @endcan

        @canany('menu-access-control', ['manage_licence','manage_prn','payment_history'])
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Manage
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('menu-access-control', 'manage_licence')
                <li class="nav-item">
                    <a href="{{route('renew-licence')}}" class="nav-link @if(Route::is('renew-licence')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Register New Licence</p>
                    </a>
                </li>
                @endcan
                @can('menu-access-control', 'manage_prn')
                <li class="nav-item">
                    <a href="{{route('request_prn')}}" class="nav-link @if(Route::is('request_prn')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Request PRN</p>
                    </a>
                </li>
                @endcan
                @can('menu-access-control', 'payment_history')
                <li class="nav-item">
                    <a href="{{route('payments_info')}}" class="nav-link @if(Route::is('payments_info')) active @endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Payment's History</p>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcanany
    </ul>
</nav>
