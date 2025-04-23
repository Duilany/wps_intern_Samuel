@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Log Harian Saya</h3>
    <a href="{{ route('logs.create') }}" class="btn btn-primary mb-3">+ Tambah Log</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Isi Log</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->tanggal->format('d M Y') }}</td>
                    <td>{{ $log->isi_log }}</td>
                    <td>
                        <span class="badge bg-{{ 
                            $log->status == 'pending' ? 'warning' : 
                            ($log->status == 'disetujui' ? 'success' : 'danger') }}">
                            {{ ucfirst($log->status) }}
                        </span>
                    </td>
                    <td>
                        @if($log->bukti)
                            <a href="{{ asset('storage/' . $log->bukti) }}" target="_blank">Lihat</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('logs.edit', $log) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('logs.destroy', $log) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus log ini?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada log.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $logs->links() }}
</div>
@endsection
