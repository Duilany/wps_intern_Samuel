@extends('layouts.guest')

@section('content')
<div class="card shadow-sm p-4 text-center">
    <h2 class="mb-3 fw-bold">Verifikasi Email</h2>

    <p class="text-muted mb-3">
        Terima kasih telah mendaftar! Silakan verifikasi email kamu dengan mengklik tautan yang kami kirimkan.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            Tautan verifikasi baru telah dikirim ke email kamu!
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="d-grid gap-2 mb-3">
        @csrf
        <button type="submit" class="btn btn-primary">
            Kirim Ulang Email Verifikasi
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-secondary w-100">
            Keluar
        </button>
    </form>
</div>
@endsection
