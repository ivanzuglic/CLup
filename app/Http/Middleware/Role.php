<?php

namespace App\Http\Middleware;

use Closure;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $role_string
     * @return mixed
     */
    public function handle($request, Closure $next, $role_string)
    {
        $user = Auth::user();
        $role = Roles::where('role_name', $role_string)->firstOrFail();

        if($user->role_id == $role->id)
        {
            return $next($request);
        }

        return redirect('/not_available');
    }
}
