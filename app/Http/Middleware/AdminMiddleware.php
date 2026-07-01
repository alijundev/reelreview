<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Pastikan user sudah login dan memiliki role admin.
     * Jika tidak, redirect ke halaman utama.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('movies.index')->with('error', 'Akses ditolak. Halaman ini hanya untuk Admin.');
        }

        return $next($request);
    }
}
