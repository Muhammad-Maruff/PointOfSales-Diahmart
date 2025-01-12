<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>Login - DiahMart POS</title>
   
    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <!-- Di bagian head -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    @if(Session::has('status'))
    <meta name="alert-status" content="{{ Session::get('status') }}">
    <meta name="alert-message" content="{{ Session::get('message') }}">
    @endif 

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="page page-center auth-page">
        <div class="floating-shapes"></div>
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <h1 class="auth-title">DiahMart POS</h1>
                <p class="auth-subtitle">Welcome back!</p>
            </div>
            <div class="card login-card" style="width=200px !important">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Login to Your Account</h2>
                        <p class="text-muted">Enter your credentials to continue</p>
                    </div>
                   
                    <form action="login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <div class="input-group input-group-flat">
                                <span class="input-group-text"><i class="ti ti-user"></i></span>
                                <input type="text" name="username" class="form-control ps-2" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <div class="input-group input-group-flat">
                                <span class="input-group-text"><i class="ti ti-lock"></i></span>
                                <input type="password" name="password" class="form-control ps-2" autocomplete="off" required>
                                <span class="input-group-text cursor-pointer toggle-password">
                                    <i class="ti ti-eye"></i>
                                </span>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-register w-100">
                                <i class="ti ti-login me-2"></i>Sign In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('register') }}" class="auth-link">
                    Don't have an account? <b>Sign up</b>
                </a>
            </div>
        </div>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- Sebelum closing body -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>


