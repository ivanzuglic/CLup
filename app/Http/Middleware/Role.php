<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, int $role_id)
    {
        $user = Auth::user();

        if($user->role_id == $role_id)
        {
            return $next($request);
        }

        return redirect('/not_available');
    }
}
