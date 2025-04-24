<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan halaman registrasi khusus staf.
     */
    public function create(): View
    {
        $roles = ['staf']; // Hanya staf
        $managers = User::where('role', 'manager')->get(); // Ambil semua manager untuk dipilih staf
        return view('auth.register', compact('roles', 'managers'));
    }

    /**
     * Proses registrasi.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', 'in:staf'], // Validasi hanya staf
            'manager_id' => ['required', 'exists:users,id'], // Harus pilih manager
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'staf',
            'manager_id' => $request->manager_id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('logs.index');
    }
}
