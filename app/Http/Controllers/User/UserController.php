<?php

namespace App\Http\Controllers\User;

use App\Events\UserCredentialsUpdateEvent;
use App\Events\UserPasswordUpdateEvent;
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
            'phone_number' => 'required|min:8|max:14'
        ]);

        $this->user->update($request->all());

        event(new UserCredentialsUpdateEvent($this->user));

        return back();
    }

    public function updatePass(Request $request)
    {

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6|same:password'
        ]);

        $request['password'] = Hash::make($request['password']);
        $this->user->update($request->all());

        event(new UserPasswordUpdateEvent($this->user));

        return back();
    }
}
