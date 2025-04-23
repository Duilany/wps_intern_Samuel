<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreLogRequest;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::where('user_id', Auth::id())->latest()->paginate(10);
        return view('logs.index', compact('logs'));
    }

    public function create()
    {
        return view('logs.create');
    }

    public function store(StoreLogRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending'; // Pastikan status default

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('bukti', 'public');
        }

        Log::create($data);

        return redirect()->route('logs.index')->with('success', 'Log berhasil dibuat.');
    }

    public function edit(Log $log)
    {
        // Pengecekan manual jika tidak menggunakan policy
        if ($log->user_id !== Auth::id() || $log->status !== 'pending') {
            abort(403, 'Akses ditolak.');
        }
        return view('logs.edit', compact('log'));
    }

    public function update(StoreLogRequest $request, Log $log)
    {
        if ($log->user_id !== Auth::id() || $log->status !== 'pending') {
            abort(403, 'Akses ditolak.');
        }

        $data = $request->validated();

        if ($request->hasFile('bukti')) {
            if ($log->bukti) {
                Storage::disk('public')->delete($log->bukti);
            }
            $data['bukti'] = $request->file('bukti')->store('bukti', 'public');
        }

        $log->update($data);

        return redirect()->route('logs.index')->with('success', 'Log berhasil diupdate.');
    }

    public function destroy(Log $log)
    {
        if ($log->user_id !== Auth::id() || $log->status !== 'pending') {
            abort(403, 'Akses ditolak.');
        }

        if ($log->bukti) {
            Storage::disk('public')->delete($log->bukti);
        }
        $log->delete();

        return redirect()->route('logs.index')->with('success', 'Log berhasil dihapus.');
    }
}