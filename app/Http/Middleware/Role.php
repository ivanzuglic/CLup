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
     * @param $access_string
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $access_string)
    {
        // Fetching the current user
        $current_user = Auth::user();

        // Exploding access_string into array around "|"
        $access_array = explode('|', $access_string);

        foreach ($access_array as $role_name)
        {
            $role = Roles::where('role_name', $role_name)->firstOrFail();

            if($current_user->role_id == $role->id)
            {
                return $next($request);
            }
        }

        return redirect('/not_available');
    }
}
