<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();

            // Check if the user's role matches the required role
            if ($user->role_id == $role) {
                // User is authenticated and has the required role, proceed with the request
                return $next($request);
            }
        }

        // User is not authenticated or does not have the required role, return a custom JSON response
        return response()->json(['message' => 'You are not authorized to log in with this role.'], 403);
    }
}
