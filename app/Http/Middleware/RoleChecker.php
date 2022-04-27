<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $manageRole, $employeeRole)
    {
        $role = Auth::user()->role_id;
        if (Auth::user()->is_admin) {
            return $next($request);
        } else if ($manageRole ==  $role) {
            return $next($request);
        } else if ($employeeRole == $role) {
            return $next($request);
        }
        return Redirect::route('login');
    }
}
