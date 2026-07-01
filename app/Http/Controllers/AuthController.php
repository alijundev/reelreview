<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ========================
    // TAMPIL FORM LOGIN
    // ========================
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('movies.index');
        }
        return view('auth.login');
    }

    // ========================
    // PROSES LOGIN
    // ========================
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect sesuai role
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('movies.index');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // ========================
    // TAMPIL FORM REGISTER
    // ========================
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('movies.index');
        }
        return view('auth.register');
    }

    // ========================
    // PROSES REGISTER
    // ========================
    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // default selalu user
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('movies.index')->with('success', 'Akun berhasil dibuat. Selamat datang, ' . $user->name . '!');
    }

    // ========================
    // LOGOUT
    // ========================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
