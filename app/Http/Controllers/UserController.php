<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('temp.users_edit', compact('user'));
    }

    public function update(User $user)
    {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'string|min:8|max:14'
        ]);


        $user->name = request('name');
        $user->email = request('email');
        $user->phone_number = request('phone_number');

        $user->save();

        return back();
    }


}
