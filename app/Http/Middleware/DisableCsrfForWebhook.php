<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DisableCsrfForWebhook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Nonaktifkan CSRF hanya untuk request dari Midtrans webhook
        if ($request->is('pembayaran/notifikasi')) {
            \Session::forget('csrf_token'); // Hapus token CSRF dari session
        }

        return $next($request);
    }
}
