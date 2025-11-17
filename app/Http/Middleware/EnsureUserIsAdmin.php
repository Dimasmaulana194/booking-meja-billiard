<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user memiliki role admin, pastikan `isAdmin()` ada di model User
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            // Jika bukan admin, redirect ke halaman beranda dengan pesan error
            return redirect()->route('beranda')->with('error', 'Anda tidak memiliki akses.');
        }

        // Lanjutkan request jika user adalah admin
        return $next($request);
    }
}
