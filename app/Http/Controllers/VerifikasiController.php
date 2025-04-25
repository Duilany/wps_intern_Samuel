<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Log::with('user', 'verifier');

        if ($request->has('log_id')) {
            $query->where('id', $request->log_id);
        } else {
            $bawahanIds = Auth::user()->bawahan->pluck('id');
            $query->whereIn('user_id', $bawahanIds);
        }

        $logs = $query->latest()->paginate(10);

        return view('verifikasi.index', compact('logs'));
    }

    public function verify(Request $request, Log $log)
{
    $bawahanIds = Auth::user()->bawahan->pluck('id');
    if (!in_array($log->user_id, $bawahanIds->toArray())) {
        abort(403, 'Akses ditolak.');
    }

    $request->validate([
        'status' => 'required|in:disetujui,ditolak',
        'komentar' => 'required|string|max:1000',
    ]);

    \Log::info('Verifikasi log input:', [
        'status' => $request->status,
        'komentar' => $request->komentar,
    ]);

    $log->update([
        'status' => $request->status,
        'komentar_verifikasi' => $request->komentar,
        'verified_by' => Auth::id(),
    ]);

    \Log::info('Data log setelah update:', $log->toArray());

    return redirect()->route('verifikasi.index')->with('success', 'Log berhasil diverifikasi.');
}

}
