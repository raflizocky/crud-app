<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $userRole = $request->session()->get('userRole');
        $currentRoute = $request->route()->getName();

        if (!in_array($userRole, $roles)) {
            return redirect('dashboard')->with('error', 'You do not have permission to access this page.');
        }

        switch ($userRole) {
            case 'superadmin':
                // Superadmin can access all routes
                break;
            case 'admin':
                if (Str::startsWith($currentRoute, 'superadmin.')) {
                    return redirect('dashboard')->with('error', 'Access Denied');
                }
                break;
            default:
                if (Str::startsWith($currentRoute, 'admin.') || Str::startsWith($currentRoute, 'superadmin.')) {
                    return redirect('dashboard')->with('error', 'Access Denied');
                }
                break;
        }

        return $next($request);
    }
}
