@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Log Harian</h3>

    <form action="{{ route('logs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="isi_log">Isi Log</label>
            <textarea name="isi_log" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="bukti">Upload Bukti (opsional)</label>
            <input type="file" name="bukti" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('logs.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
