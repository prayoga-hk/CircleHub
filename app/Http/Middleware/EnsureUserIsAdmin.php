<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek: user sudah login DAN rolenya 'admin'?
        if (! auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized - Hanya admin yang bisa akses.');
        }

        return $next($request);
    }
}
