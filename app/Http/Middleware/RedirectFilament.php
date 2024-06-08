<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RedirectFilament
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentRouteName = $request->getRequestUri();

        if ($currentRouteName == '/admin/orders') {
            // Get the authenticated user
            $user = Auth::user();
            
            if ($user && $user->name !== 'admin') {
                // Redirect to /admin
                return redirect('/admin');
            }
        }

        return $next($request);
    }
}
