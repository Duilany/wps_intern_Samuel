<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Log Harian</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
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
        .btn-signin {
            background-color: #28a745;
            border-color: #28a745;
            font-size: 1.25rem;
            padding: 10px 30px;
            border-radius: 25px;
            transition: background-color 0.3s;
        }
        .btn-signin:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-register {
            background-color: transparent;
            border-color: #1a3c6d;
            color: #1a3c6d;
            font-size: 1.25rem;
            padding: 10px 30px;
            border-radius: 25px;
            transition: background-color 0.3s;
        }
        .btn-register:hover {
            background-color: #1a3c6d;
            color: white;
        }
        .footer {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 20px 0;
            color: #1a3c6d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Logo -->
    <div class="logo">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="10" stroke="#1a3c6d" stroke-width="2"/>
            <path d="M12 6v6l4 2" stroke="#1a3c6d" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span class="ms-2 text-dark fw-bold">Sistem Log Harian</span>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 welcome-text">
                    <h1>SELAMAT DATANG KEMBALI!</h1>
                    <p>Akses catatan harian Anda untuk melanjutkan</p>
                </div>
                <div class="col-lg-6 text-center">
                    <a href="{{ route('login') }}" class="btn btn-signin mb-3">MASUK</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-register">DAFTAR</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 Sistem Log Harian.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
