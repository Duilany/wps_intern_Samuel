@extends('layouts.app')

@section('title', 'Verifikasi Log')

@section('content')
    <h1>Verifikasi Log Harian</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pegawai</th>
                <th>Isi Log</th>
                <th>Bukti</th>
                <th>Status</th>
                <th>Diverifikasi Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->tanggal->format('Y-m-d') }}</td>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ $log->isi_log }}</td>
                    <td>
                        @if ($log->bukti)
                            <a href="{{ Storage::url($log->bukti) }}" target="_blank">Lihat Bukti</a>
                        @else
                            Tidak ada
                        @endif
                    </td>
                    <td>{{ ucfirst($log->status) }}</td>
                    <td>{{ $log->verifier ? $log->verifier->name : '-' }}</td>
                    <td>
                        @if ($log->status === 'pending')
                            <form action="{{ route('verifikasi.verify', $log) }}" method="POST">
                                @csrf
                                <select name="status" class="form-control d-inline w-auto">
                                    <option value="disetujui">Disetujui</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Verifikasi</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $logs->links() }}
@endsection