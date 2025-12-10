<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan login terlebih dahulu.');
        }

        // Jika role user cocok dengan salah satu role yang diizinkan
        if (in_array(Auth::user()->role, $roles)) {
            return $next($request); // <── WAJIB ADA!!
        }

        // Jika tidak sesuai → forbidden
        return abort(403, 'Anda tidak memiliki akses.');
    }
}
