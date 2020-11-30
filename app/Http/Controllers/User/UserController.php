<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function edit()
    {
        $user = $this->user;
        return view('temp.users_edit', compact('user'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'email|string|max:255|required|unique:users,email,'.$this->user->id,
         //   'password' => 'string|min:6|confirmed',
            'phone_number' => 'required|min:8|max:14'
        ]);

//        $this->user->name = $request->name;
//        $this->user->email = $request->email;
//        $this->user->phone_number = $request->phone_number;

//        $this->user->save();
    //    $request['password'] = Hash::make($request['password']);
        $this->user->update($request->all());

        return back();
    }

    public function updatePass(Request $request)
    {

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

//        $this->user->name = $request->name;
//        $this->user->email = $request->email;
//        $this->user->phone_number = $request->phone_number;

//        $this->user->save();
        $request['password'] = Hash::make($request['password']);
        $this->user->update($request->all());

        return back();
    }
}
