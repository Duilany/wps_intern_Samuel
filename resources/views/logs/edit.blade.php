@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Log Harian</h3>

    <form action="{{ route('logs.update', $log) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $log->tanggal->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="isi_log">Isi Log</label>
            <textarea name="isi_log" class="form-control" required>{{ $log->isi_log }}</textarea>
        </div>

        <div class="mb-3">
            <label for="bukti">Ganti Bukti (opsional)</label>
            @if($log->bukti)
                <p><a href="{{ asset('storage/' . $log->bukti) }}" target="_blank">Lihat Bukti Sebelumnya</a></p>
            @endif
            <input type="file" name="bukti" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('logs.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
