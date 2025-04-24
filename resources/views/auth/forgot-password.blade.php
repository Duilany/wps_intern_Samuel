@extends('layouts.guest')

@section('content')
<div class="card shadow-sm p-4">
    <h2 class="text-center mb-3 fw-bold">Lupa Password</h2>

    <p class="text-muted text-center mb-4">
        Lupa password? Masukkan email kamu, kami akan mengirimkan link reset password ke email tersebut.
    </p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">
                Kirim Link Reset Password
            </button>
        </div>
    </form>
</div>
@endsection
