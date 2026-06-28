<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Smart Garments Management System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1F3864 0%, #2E75B6 50%, #1F3864 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #1F3864, #2E75B6);
            padding: 36px 40px 28px;
            text-align: center;
            color: white;
        }

        .login-header .logo-icon {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 32px;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .login-header h4 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .login-header p {
            font-size: 13px;
            opacity: 0.8;
        }

        .login-body {
            padding: 36px 40px;
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #444;
            margin-bottom: 6px;
        }

        .form-control {
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #2E75B6;
            box-shadow: 0 0 0 3px rgba(46,117,182,0.15);
        }

        .input-group .form-control {
            border-right: none;
        }

        .input-group .btn-outline-secondary {
            border: 1.5px solid #e0e0e0;
            border-left: none;
            border-radius: 0 8px 8px 0;
            background: #f8f9fa;
            color: #666;
        }

        .input-group .btn-outline-secondary:hover {
            background: #e9ecef;
        }

        .btn-login {
            background: linear-gradient(135deg, #1F3864, #2E75B6);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 15px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s;
            margin-top: 8px;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(31,56,100,0.4);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .form-check-label {
            font-size: 13px;
            color: #666;
        }

        .login-footer {
            background: #f8f9fa;
            padding: 16px 40px;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .login-footer p {
            font-size: 12px;
            color: #999;
            margin: 0;
        }

        .alert-danger {
            border-radius: 8px;
            font-size: 13px;
            border: none;
            background: #fef2f2;
            color: #dc2626;
            padding: 10px 14px;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        {{-- Header --}}
        <div class="login-header">
            <div class="logo-icon">
                <i class="bi bi-building"></i>
            </div>
            <h4>Smart Garments</h4>
            <p>Management System</p>
        </div>

        {{-- Body --}}
        <div class="login-body">
            <h5 class="fw-bold mb-1" style="color:#1F3864;">Welcome Back!</h5>
            <p class="text-muted mb-4" style="font-size:13px;">Please sign in to your account</p>

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            {{-- Login Form --}}
            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text" style="border:1.5px solid #e0e0e0; border-right:none; background:#f8f9fa; border-radius:8px 0 0 8px;">
                            <i class="bi bi-envelope" style="color:#2E75B6;"></i>
                        </span>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your email"
                            value="{{ old('email') }}"
                            required
                            style="border-left:none;"
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text" style="border:1.5px solid #e0e0e0; border-right:none; background:#f8f9fa; border-radius:8px 0 0 8px;">
                            <i class="bi bi-lock" style="color:#2E75B6;"></i>
                        </span>
                        <input
                            type="password"
                            name="password"
                            id="passwordInput"
                            class="form-control"
                            placeholder="Enter your password"
                            required
                            style="border-left:none; border-right:none;"
                        >
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                </button>
            </form>
        </div>

        {{-- Footer --}}
        <div class="login-footer">
            <p>© 2026 Smart Garments Management System. All rights reserved.</p>
        </div>

    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    // SweetAlert2 — error থাকলে show করো
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#2E75B6',
            timer: 3000,
            timerProgressBar: true,
        });
    @endif
</script>

</body>
</html>