@extends('layouts.guest')

@section('content')
<div class="card shadow-sm p-4">
    <h2 class="text-center mb-3 fw-bold">Reset Password</h2>

    <p class="text-muted text-center mb-3">
        Silakan masukkan password baru untuk akun kamu.
    </p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email"
                   value="{{ old('email', $request->email) }}"
                   class="form-control @error('email') is-invalid @enderror" required autofocus>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="form-control" required>
        </div>

        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">
                Reset Password
            </button>
        </div>
    </form>
</div>
@endsection
