<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class accessCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
        public function handle(Request $request, Closure $next, ...$roles)
    {
       if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
    }

    $user = auth()->user();

    // Check if user has one of the allowed roles
    if (in_array($user->role, $roles)) {
        return $next($request);
    }

    

    return redirect(route('unauthorized'));
}
}
