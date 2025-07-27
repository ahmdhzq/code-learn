<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - CodeLearn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #317a75 0%, #2a6b66 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .auth-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-primary {
            background-color: #317a75;
            border-color: #317a75;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #2a6b66;
            border-color: #2a6b66;
        }

        .text-primary {
            color: #317a75 !important;
        }

        .form-control:focus {
            border-color: #317a75;
            box-shadow: 0 0 0 0.2rem rgba(49, 122, 117, 0.25);
        }

        .auth-link {
            color: #317a75;
            text-decoration: none;
        }

        .auth-link:hover {
            color: #2a6b66;
            text-decoration: underline;
        }

        .floating-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
            top: 0;
            left: 0;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 50%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 70%;
            right: 25%;
            animation-delay: 1s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .strength-weak {
            background-color: #dc3545;
            width: 33%;
        }

        .strength-fair {
            background-color: #ffc107;
            width: 66%;
        }

        .strength-strong {
            background-color: #198754;
            width: 100%;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container" style="z-index: 2; position: relative;">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card auth-card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <div class="mb-4">
                                <i class="fas fa-code text-primary fs-1"></i>
                            </div>
                            <h2 class="fw-bold text-dark mb-2">Join CodeLearn!</h2>
                            <p class="text-muted">Mulai journey programming Anda bersama kami</p>
                        </div>

                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                                        required autofocus autocomplete="name"
                                        class="form-control border-start-0 @error('name') is-invalid @enderror"
                                        placeholder="Masukkan nama lengkap Anda">
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        required autocomplete="username"
                                        class="form-control border-start-0 @error('email') is-invalid @enderror"
                                        placeholder="Masukkan email Anda">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input id="password" type="password" name="password" required
                                        autocomplete="new-password"
                                        class="form-control border-start-0 @error('password') is-invalid @enderror"
                                        placeholder="Masukkan password Anda">
                                    <button class="btn btn-outline-secondary border-start-0" type="button"
                                        id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>

                                <!-- Password Guidelines -->
                                <div class="mt-2 mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Password harus memiliki minimal 8 karakter, kombinasi huruf besar, kecil, angka,
                                        dan simbol untuk keamanan maksimal
                                    </small>
                                </div>

                                <!-- Password Strength Indicator -->
                                <div class="mt-2">
                                    <div class="bg-light rounded-2" style="height: 4px;">
                                        <div id="passwordStrength" class="password-strength rounded-2 d-none"></div>
                                    </div>
                                    <small id="passwordStrengthText" class="text-muted"></small>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-semibold">Confirm
                                    Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                        required autocomplete="new-password"
                                        class="form-control border-start-0 @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Konfirmasi password Anda">
                                    <button class="btn btn-outline-secondary border-start-0" type="button"
                                        id="togglePasswordConfirm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div id="passwordMatch" class="mt-1"></div>
                                @error('password_confirmation')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label small" for="terms">
                                        Saya setuju dengan
                                        <a href="#" class="auth-link">Terms of Service</a>
                                        dan
                                        <a href="#" class="auth-link">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3">
                                    Create Account
                                </button>
                            </div>

                            <div class="text-center">
                                <p class="text-muted mb-0">
                                    Sudah punya akun?
                                    <a href="{{ route('login') }}" class="auth-link fw-semibold">
                                        Masuk sekarang
                                    </a>
                                </p>
                            </div>
                        </form>


                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('welcome') }}" class="text-white text-decoration-none">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
            const password = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordStrengthText');

            strengthBar.className = 'password-strength rounded-2';

            if (password.length === 0) {
                strengthBar.classList.add('d-none');
                strengthText.textContent = '';
                return;
            }

            strengthBar.classList.remove('d-none');

            const hasLowerCase = /[a-z]/.test(password);
            const hasUpperCase = /[A-Z]/.test(password);
            const hasNumbers = /[0-9]/.test(password);
            const hasSymbols = /[^A-Za-z0-9]/.test(password);
            const isLongEnough = password.length >= 8;
            if (password.length < 8) {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = 'Password lemah - minimal 8 karakter';
                strengthText.className = 'small text-danger';
            } else if (isLongEnough && hasLowerCase && hasUpperCase && hasNumbers && !hasSymbols) {
                strengthBar.classList.add('strength-fair');
                strengthText.textContent = 'Password cukup - tambahkan simbol untuk lebih kuat';
                strengthText.className = 'small text-warning';
            } else if (isLongEnough && hasLowerCase && hasUpperCase && hasNumbers && hasSymbols) {
                strengthBar.classList.add('strength-strong');
                strengthText.textContent = 'Password kuat';
                strengthText.className = 'small text-success';
            } else {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = 'Password lemah - gunakan kombinasi huruf besar, kecil, angka';
                strengthText.className = 'small text-danger';
            }
        });
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            const matchIndicator = document.getElementById('passwordMatch');

            if (confirmPassword.length === 0) {
                matchIndicator.innerHTML = '';
            } else if (password === confirmPassword) {
                matchIndicator.innerHTML =
                    '<small class="text-success"><i class="fas fa-check me-1"></i>Password cocok</small>';
            } else {
                matchIndicator.innerHTML =
                    '<small class="text-danger"><i class="fas fa-times me-1"></i>Password tidak cocok</small>';
            }
        });
    </script>
</body>

</html>
