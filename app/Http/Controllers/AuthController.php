<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;
use Spatie\Permission\Traits\HasRoles;

class AuthController extends Controller
{
    public function showAdminLogin()
    {
        return view('admin.login', ['role' => 'admin']);
    }

    public function showKasirLogin()
    {
        return view('kasir.login', ['role' => 'kasir']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->intended(route('dashboard'));
            }

            if ($user->hasRole('kasir')) {
                return redirect()->intended(route('manajemen.kasir'));
            }

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}
