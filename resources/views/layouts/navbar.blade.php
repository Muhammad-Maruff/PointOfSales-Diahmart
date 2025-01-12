<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex">
    <div class="container-fluid">
        <div class="navbar-nav flex-row order-md-last">
            <!-- User Menu -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
                    <span class="avatar avatar-sm">JD</span>
                    <div class="d-none d-xl-block ps-2">
                        <div>John Doe</div>
                        <div class="mt-1 small text-muted">Administrator</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="/logout" class="dropdown-item text-danger">Logout</a>
                </div>
            </div>
        </div>
        
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            @yield('breadcrumb')
        </div>
    </div>
</header>
