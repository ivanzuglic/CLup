<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Roles;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        $user = Auth::user();
        $role_id = $user->role_id;

        $role = Roles::where('id', $role_id)->firstOrFail();

        switch ($role->role_name) {
            case 'admin':
                return '/admin/dashboard/add_store';

            case 'manager':
                return "/manager/dashboard/store_parameters/{$user->store_id}";

            default:
                return '/home';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
