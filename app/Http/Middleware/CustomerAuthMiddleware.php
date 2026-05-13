<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('customer')->check()) {
            return $next($request);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        return redirect()->route('home')->with('error', 'Please login to access this page.');
    }
}
