@extends('layouts.guest')

@section('content')
    <!-- Tambahkan Bootstrap CDN di layout guest jika belum ada -->
    <div class="container">
        <h2 class="text-center mb-4">Pendaftaran Akun Log Staf</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hidden Role -->
            <input type="hidden" name="role" value="staf">

            <!-- Pilih Bidang -->
            <div class="mb-3">
                <label for="manager_id" class="form-label">Pilih Bidang Staf</label>
                <select class="form-select @error('manager_id') is-invalid @enderror" name="manager_id" required>
                    <option value="">-- Pilih Bidang --</option>
                    @foreach ($managers as $manager)
                        <option value="{{ $manager->id }}" {{ old('manager_id') == $manager->id ? 'selected' : '' }}>
                            {{ $manager->name }}
                        </option>
                    @endforeach
                </select>
                @error('manager_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <input id="password_confirmation" type="password"
                       class="form-control" name="password_confirmation" required>
            </div>

            <!-- Tombol Register -->
            <div class="d-flex justify-content-between align-items-center">
                <a class="text-decoration-none" href="{{ route('login') }}">
                    Sudah punya akun?
                </a>
                <button type="submit" class="btn btn-primary">
                    Daftar
                </button>
            </div>
        </form>
    </div>
@endsection
