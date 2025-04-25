@extends('layouts.app')

@section('title', 'Verifikasi Log')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary mb-0">
            <i class="bi bi-check-circle me-2"></i> Verifikasi Log Harian Pegawai
        </h3>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
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
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->tanggal->format('Y-m-d') }}</td>
                            <td>{{ $log->user->name }}</td>
                            <td>{{ $log->isi_log }}</td>
                            <td>
                                @if ($log->bukti)
                                    <a href="{{ Storage::url($log->bukti) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-file-earmark-text me-1"></i> Bukti
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ 
                                    $log->status === 'pending' ? 'warning' : 
                                    ($log->status === 'disetujui' ? 'success' : 'danger') }}">
                                    {{ ucfirst($log->status) }}
                                </span>
                            </td>
                            <td>{{ $log->verifier ? $log->verifier->name : '-' }}</td>
                            <td>
                                @if ($log->status === 'pending')
                                    <form action="{{ route('verifikasi.verify', $log) }}" method="POST" class="d-flex flex-column gap-2">
                                        @csrf
                                        <div class="d-flex align-items-center gap-2">
                                            <select name="status" class="form-select form-select-sm w-auto" required>
                                                <option value="disetujui">Disetujui</option>
                                                <option value="ditolak">Ditolak</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="bi bi-check-circle me-1"></i> Verifikasi
                                            </button>
                                        </div>
                                        <textarea name="komentar" class="form-control form-control-sm" placeholder="Catatan/komentar..." rows="2" required></textarea>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">Belum ada log yang perlu diverifikasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
