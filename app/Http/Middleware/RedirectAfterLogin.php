<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectAfterLogin
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Kalau user sudah login dan berada di halaman login/register
        if ($request->routeIs('login') || $request->routeIs('register')) {
            if (Auth::check()) {
                $role = Auth::user()->role;

                if ($role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                return redirect()->route('dashboard');
            }
        }

        return $response;
    }
}
