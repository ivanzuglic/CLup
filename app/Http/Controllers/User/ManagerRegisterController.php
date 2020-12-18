<?php

namespace App\Http\Controllers\User;

use App\Events\ManagerCreatedEvent;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

class ManagerRegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Manager Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of Managers by Admin as well as their
    | validation and creation.
    |
    */


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard'; // TODO: decide where to redirect

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
//     * @return \App\User
     */
    protected function create(Request $data)
    {

       if (Gate::allows('ManagerRegister', Auth::user())) {

           $possibleChars = '123456789abcdefghjkmnpqrstuvxyzABCDEFGHJKMNPQRSTUVWXYZ';

           $random = '';
           for ($i = 0; $i < 10; $i++) {
               $random .= $possibleChars[rand(0, strlen($possibleChars) - 1)];
           }

           $data['password'] = $random;

           $data->validate([
               'name' => 'required|string|max:255',
               'email' => 'required|string|email|max:255|unique:users',
               'password' => 'required|string|min:6',
               'phone_number' => 'string|min:8|max:14',
               'store_id' => 'required|integer|exists:stores,store_id'
           ]);

           $manager_user = User::create([
               'name' => $data['name'],
               'email' => $data['email'],
               'password' => Hash::make($data['password']),
               'phone_number' => $data['phone_number'],
               'store_id' => $data['store_id'],
               'role_id' => '3',
           ]);

           $encrypted_pass = Crypt::encryptString($data['password']);
           event(new ManagerCreatedEvent($manager_user, $encrypted_pass));
       }
       return back();
     }
}
