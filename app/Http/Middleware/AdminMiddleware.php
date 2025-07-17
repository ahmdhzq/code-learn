<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            // Jika ya, lanjutkan ke halaman yang dituju
            return $next($request);
        }

        // Jika tidak, kembalikan ke halaman utama dengan pesan error
        return redirect('/')->with('error', 'Anda tidak memiliki hak akses.');
    }
}
