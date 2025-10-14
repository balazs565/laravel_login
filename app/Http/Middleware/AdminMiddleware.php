<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;
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
        $user = $request->user();

        // If user is not authenticated, redirect to login (use named route if available)
        if (! $user) {
            // use a safe URL; named routes in this app are not present by default
            return redirect()->guest(url('/login'));
        }

        // If user authenticated but not admin, return appropriate 403
        if ($user->role !== 'admin') {
            $message = 'Neautorizat.';

            if ($request->expectsJson()) {
                return response()->json(['message' => $message], 403);
            }

            // For web requests, redirect to dashboard (named route if available) with a flash message and 403 status
            // redirect to dashboard path with an error message
            return redirect(url('/dashboard'))->with('error', $message)->setStatusCode(403);
        }
        return $next($request);
    }
}
