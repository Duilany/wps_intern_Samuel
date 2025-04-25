@extends('layouts.guest')

@section('content')
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"%3E%3Cpath fill="%23ffffff" fill-opacity="0.5" d="M0,224L48,208C96,192,192,160,288,138.7C384,117,480,107,576,122.7C672,139,768,181,864,186.7C960,192,1056,160,1152,149.3C1248,139,1344,149,1392,154.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"%3E%3C/path%3E%3C/svg%3E');
            background-size: cover;
            background-position: bottom;
            z-index: 1;
        }
        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"%3E%3Cpath fill="%23ffffff" fill-opacity="0.3" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,170.7C1248,181,1344,203,1392,213.3L1440,224L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"%3E%3C/path%3E%3C/svg%3E');
            background-size: cover;
            background-position: top;
            z-index: 1;
        }
        .content {
            position: relative;
            z-index: 2;
            flex-grow: 1;
            display: flex;
            align-items: center;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 3;
        }
        .welcome-text h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #1a3c6d;
        }
        .welcome-text p {
            font-size: 1.25rem;
            color: #1a3c6d;
        }
        .login-form {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-login {
            background-color: #28a745;
            border-color: #28a745;
            font-size: 1.25rem;
            padding: 10px 30px;
            border-radius: 25px;
            transition: background-color 0.3s;
        }
        .btn-login:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .footer {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 20px 0;
            color: #1a3c6d;
            font-size: 0.9rem;
        }
        .form-control {
            border-radius: 25px;
            padding: 10px 20px;
        }
        .input-group-text {
            border-radius: 25px 0 0 25px;
            background-color: #f8f9fa;
        }
    </style>

    <!-- Logo -->
    <div class="logo">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="10" stroke="#1a3c6d" stroke-width="2"/>
            <path d="M12 6v6l4 2" stroke="#1a3c6d" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span class="ms-2 text-dark fw-bold">Sistem Log Harian</span>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 welcome-text">
                    <h1>SELAMAT DATANG KEMBALI!</h1>
                    <p>Masukkan ID dan Kata Sandi Anda untuk melanjutkan</p>
                </div>
                <div class="col-lg-6">
                    <div class="login-form">
                        <h2 class="text-center mb-4">MASUK UNTUK MENGAKSES PORTAL</h2>
                        
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Nama Pengguna" required autofocus autocomplete="username">
                                </div>
                                @if ($errors->has('email'))
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input id="password" class="form-control" type="password" name="password" placeholder="Masukkan Kata Sandi" required autocomplete="current-password">
                                </div>
                                @if ($errors->has('password'))
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('password') }}</p>
                                @endif
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-3">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                                </label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-primary hover:underline" href="{{ route('password.request') }}">
                                        {{ __('Lupa Kata Sandi?') }}
                                    </a>
                                @endif

                                <button type="submit" class="btn btn-login">
                                    {{ __('Masuk') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 Sistem Log Harian.</p>
    </div>
@endsection