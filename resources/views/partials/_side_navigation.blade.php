<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
            <a href="/" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-header">MENUS</li>
        <li class="nav-item">
            <a href="{{route('my-profile')}}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                    My Profile
                </p>
            </a>
        </li>
        @if(Auth::user()->access == 1)
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                        Users
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('add-users')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add New</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('view-users')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View All</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Municipals
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('add-municipals')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add New</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('view-municipals')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View All</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Manage
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('renew-licence')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Register New Licence</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('request_prn')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Request PRN</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('payments_info')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Payment's History</p>
                    </a>
                </li>
            </ul>
        </li>
        @if(Auth::user()->access == 1)
        <li class="nav-item">
            <a href="{{route('logs-list')}}" class="nav-link">
                <i class="nav-icon fas fa-cog fa-spin"></i>
                <p>
                    Logs
                </p>
            </a>
        </li>
        @endif
    </ul>
</nav>
