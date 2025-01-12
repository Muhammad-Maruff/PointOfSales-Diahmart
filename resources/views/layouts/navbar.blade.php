<header class="navbar navbar-expand-md navbar-dark" style="background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%)">
    <div class="container-fluid">
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-white p-0" data-bs-toggle="dropdown">
                    <span class="avatar avatar-sm">JD</span>
                    <div class="d-none d-xl-block ps-2">
                        <div class="text-white">John Doe</div>
                        <div class="mt-1 small text-white opacity-75">Administrator</div>
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
        
        <div class="breadcrumb text-white">
            @yield('breadcrumb')
        </div>
    </div>
</header>
