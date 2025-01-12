<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>Register - DiahMart POS</title>
   
    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="page page-center auth-page">
        <div class="floating-shapes"></div>
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <h1 class="auth-title">DiahMart POS</h1>
                <p class="auth-subtitle">Start your journey with us</p>
            </div>
            <div class="card auth-card">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Create New Account</h2>
                        <p class="text-muted">Fill in your details to get started</p>
                    </div>
                   
                    @if(Session::has('status'))
                    <div class="alert alert-{{ Session::get('status') }} alert-dismissible fade show" role="alert">
                        <div class="d-flex">
                            <div><i class="ti ti-{{ Session::get('status') == 'success' ? 'circle-check' : 'alert-circle' }} me-2"></i></div>
                            <div>{{ Session::get('message') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('registerProcess') }}" method="post">
                        @csrf
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text"><i class="ti ti-user"></i></span>
                                        <input type="text" name="nama" class="form-control ps-2" autocomplete="off" required  >
                                    </div>
                                </div>
                    
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                        <input type="email" name="email" class="form-control ps-2" autocomplete="off" required>
                                    </div>
                                </div>
                    
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text"><i class="ti ti-phone"></i></span>
                                        <input type="number" name="phone_number" class="form-control ps-2" autocomplete="off" required>
                                    </div>
                                </div>
                    
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text"><i class="ti ti-map-pin"></i></span>
                                        <textarea name="address" class="form-control ps-2" rows="2" autocomplete="off" required></textarea>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text"><i class="ti ti-at"></i></span>
                                        <input type="text" name="username" class="form-control ps-2" autocomplete="off" required>
                                    </div>
                                </div>
                    
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text"><i class="ti ti-lock"></i></span>
                                        <input type="password" name="password" class="form-control ps-2" autocomplete="off" required>
                                        <span class="input-group-text cursor-pointer toggle-password">
                                            <i class="ti ti-eye"></i>
                                        </span>
                                    </div>
                                </div>
                    
                                <div class="mb-4">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-group input-group-flat">
                                        <span class="input-group-text"><i class="ti ti-lock-check"></i></span>
                                        <input type="password" name="password_confirmation" class="form-control ps-2" autocomplete="off" required>
                                        <span class="input-group-text cursor-pointer toggle-password">
                                            <i class="ti ti-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-footer">
                            <button type="submit" class="btn btn-register w-100">
                                <i class="ti ti-user-plus me-2"></i>Create Account
                            </button>
                        </div>
                    </form>
                    
                    
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="auth-link">
                    Already have an account? <b>Sign in</b>
                </a>
            </div>
        </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
