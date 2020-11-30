<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * @return \App\User
     */
    protected function create(Request $data)
    {

       if (Gate::allows('ManagerRegister')) {
          $data->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|string|email|max:255|unique:users',
              'password' => 'required|string|min:6|confirmed',
              'phone_number' => 'string|min:8|max:14'
          ]);

           User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone_number' => $data['phone_number'],
                'store_id' => $data['store_id'],
                'role_id' => '3',
            ]);
       }
       return back();
     }
}
