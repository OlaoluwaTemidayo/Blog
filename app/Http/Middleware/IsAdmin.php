<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has an admin role
        if (auth()->user()->role !== 'admin') {
            return $next($request);
        }

        // Redirect non-admin users to the home page with a message
        return redirect('/')->with('error', 'You do not have admin access.');
    }
}
