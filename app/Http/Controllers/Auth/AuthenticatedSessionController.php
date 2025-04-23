<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
  public function store(Request $request)
{
    // dd($request->all());
    \Log::info('Login attempt', [
        'input' => $request->all(),
        'session' => session()->all(),
        'csrf_token' => $request->session()->token(),
    ]);

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        \Log::info('Login successful', [
            'user' => $user->email,
            'role' => $user->role,
        ]);

        switch ($user->role) {
    case 'direktur':
        return redirect()->route('calendar.index');

    case 'manager':
    case 'manager_operasional':
    case 'manager_keuangan':
        return redirect()->route('verifikasi.index');

    case 'staf':
    case 'staff_operasional':
    case 'staff_keuangan':
        return redirect()->route('logs.index');

    default:
        Auth::logout();
        return redirect()->route('login')->withErrors([
            'email' => 'Peran pengguna tidak dikenali.',
        ]);
}

    }

    \Log::warning('Login failed', [
        'input' => $request->only('email'),
    ]);

    return back()->withErrors([
        'email' => 'Kredensial tidak sesuai.',
    ]);
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
