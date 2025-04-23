<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiController extends Controller
{
    public function index(Request $request)
    {
        $bawahanIds = Auth::user()->bawahan->pluck('id');
        $logs = Log::whereIn('user_id', $bawahanIds)
            ->latest()
            ->paginate(10);

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
        ]);

        $log->update([
            'status' => $request->status,
            'verified_by' => Auth::id(),
        ]);

        return redirect()->route('verifikasi.index')->with('success', 'Log berhasil diverifikasi.');
    }
}