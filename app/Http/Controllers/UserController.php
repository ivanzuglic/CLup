<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
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
//        $validator=$this->validator2($request->all())->validate();

//        if ($validator->fails()) {
//            return redirect('/users_edit')
//                ->withErrors($validator)
//                ->withInput();
//        }

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'phone_number' => 'required'
        ]);

        $this->user->name = $request->name;
        $this->user->email = $request->email;
        $this->user->phone_number = $request->phone_number;

        $this->user->save();

        return back();
    }

    public function validator2(array $data)
    {
        return Validator::make($data, [

            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'phone_number' => 'string|min:8|max:14'
        ],[
            'name.required'=>'greska'
        ]);
    }


}
