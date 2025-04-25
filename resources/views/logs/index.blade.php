@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary mb-0">
            <i class="bi bi-journal-text me-2"></i> Log Harian Saya
        </h3>
        <a href="{{ route('logs.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Tambah Log
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @forelse($logs as $log)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="fw-semibold text-dark">{{ $log->tanggal->format('d M Y') }}</h5>
                    <p class="mb-2">{{ $log->isi_log }}</p>

                    <div class="mb-1">
                        <span class="badge bg-{{ 
                            $log->status === 'pending' ? 'warning' : 
                            ($log->status === 'disetujui' ? 'success' : 'danger') }}">
                            {{ ucfirst($log->status) }}
                        </span>
                    </div>

                    @if($log->status !== 'pending' && $log->komentar_verifikasi)
                        <div class="text-muted small fst-italic">
                            💬 <strong>Catatan Manager:</strong> {{ $log->komentar_verifikasi }}
                        </div>
                    @endif

                    @if($log->bukti)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $log->bukti) }}" target="_blank" class="text-decoration-underline">
                                <i class="bi bi-paperclip me-1"></i>Lihat Bukti
                            </a>
                        </div>
                    @endif
                </div>

                @if($log->status === 'pending')
                    <div class="text-end">
                        <a href="{{ route('logs.edit', $log) }}" class="btn btn-sm btn-outline-warning me-2">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('logs.destroy', $log) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Yakin hapus log ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle me-1"></i> Belum ada log harian yang dibuat.
        </div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $logs->links() }}
    </div>
</div>
@endsection
