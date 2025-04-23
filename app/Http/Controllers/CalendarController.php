<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->query('month', now()->format('Y-m'));
        $start = \Carbon\Carbon::parse($month)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $bawahanIds = Auth::user()->bawahan->pluck('id');
        $logs = Log::whereIn('user_id', $bawahanIds)
            ->whereBetween('tanggal', [$start, $end])
            ->get();

        return view('dashboard', compact('logs', 'month'));
    }

    public function data(Request $request)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        $bawahanIds = Auth::user()->bawahan->pluck('id');
        $logs = Log::whereIn('user_id', $bawahanIds)
            ->whereBetween('tanggal', [$start, $end])
            ->get();

        $events = $logs->map(function ($log) {
            return [
                'title' => $log->user->name . ' (' . ucfirst($log->status) . ')',
                'start' => $log->tanggal->toDateString(),
                'color' => match($log->status) {
                    'pending' => '#ffc107',
                    'disetujui' => '#28a745',
                    'ditolak' => '#dc3545',
                },
                'url' => route('verifikasi.index') . '?log_id=' . $log->id, // Link ke halaman verifikasi
            ];
        });

        return response()->json($events);
    }
}