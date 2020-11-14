<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        if (Auth::guard($guard)->check()) {
//            return redirect('/home');
//        }

        if (Auth::guard($guard)->check()) {
            $role_id = Auth::user()->role_id;

            switch ($role_id) {
                case '1':
                    return redirect('/admin/dashboard');
                    break;

                case '3':
                    return redirect('/manager/dashboard');
                    break;

                default:
                    return redirect('/home');
                    break;
            }
        }
        return $next($request);
    }
}
