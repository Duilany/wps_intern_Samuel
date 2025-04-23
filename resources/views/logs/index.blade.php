@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-semibold">📒 Log Harian Saya</h3>
        <a href="{{ route('logs.create') }}" class="btn btn-success">
            + Tambah Log
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @forelse($logs as $log)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="mb-1">{{ $log->tanggal->format('d M Y') }}</h5>
                        <p class="mb-2">{{ $log->isi_log }}</p>
                        <span class="badge bg-{{ 
                            $log->status == 'pending' ? 'warning' : 
                            ($log->status == 'disetujui' ? 'success' : 'danger') }}">
                            {{ ucfirst($log->status) }}
                        </span>
                        @if($log->bukti)
                            <span class="ms-2">
                                <a href="{{ asset('storage/' . $log->bukti) }}" target="_blank" class="text-decoration-underline">Lihat Bukti</a>
                            </span>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('logs.edit', $log) }}" class="btn btn-sm btn-outline-warning me-2">Edit</a>
                        <form action="{{ route('logs.destroy', $log) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Yakin hapus log ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">Belum ada log harian yang dibuat.</div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $logs->links() }}
    </div>
</div>
@endsection
