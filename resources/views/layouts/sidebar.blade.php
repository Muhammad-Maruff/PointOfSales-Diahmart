<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%)">
    <div class="container-fluid">
        <h1 class="navbar-brand">
            <a href="{{ route('dashboard') }}" class="text-white">DiahMart POS</a>
        </h1>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-dashboard icon"></i>
                        </span>
                        <span class="nav-link-title">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-box icon"></i>
                        </span>
                        <span class="nav-link-title">Products</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}" href="">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-receipt icon"></i>
                        </span>
                        <span class="nav-link-title">Transactions</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('reports*') ? 'active' : '' }}" href="">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-report icon"></i>
                        </span>
                        <span class="nav-link-title">Reports</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
