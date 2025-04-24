@extends('layouts.guest')

@section('content')
<div class="card shadow-sm p-4">
    <h2 class="text-center mb-3 fw-bold">Konfirmasi Password</h2>

    <p class="text-muted text-center mb-4">
        Halaman ini aman. Silakan masukkan password kamu sebelum melanjutkan.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">
                Konfirmasi
            </button>
        </div>
    </form>
</div>
@endsection
