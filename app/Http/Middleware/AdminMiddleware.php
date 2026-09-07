<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Must be authenticated via the 'web' guard AND have is_admin flag
        if (Auth::guard('web')->check() && Auth::guard('web')->user()->is_admin) {
            return $next($request);
        }

        // Customers authenticated via 'customer' guard must NOT access admin
        return redirect()->route('admin.login')->with('error', 'Unauthorized access.');
    }
}
