<?php

namespace App\Http\Middleware;

use App\Roles;
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
            $user = Auth::user();
            $role_id = $user->role_id;

            $role = Roles::where('id', $role_id)->firstOrFail();

            switch ($role->role_name) {
                case 'admin':
                    return redirect('/admin/dashboard/add_store');

                case 'manager':
                    return redirect("/manager/dashboard/store_parameters/{$user->store_id}");

                default:
                    return redirect('/home');
            }
        }
        return $next($request);
    }
}
