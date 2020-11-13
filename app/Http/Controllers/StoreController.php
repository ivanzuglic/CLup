<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();

    }

    public function create ()
    {


    }

    public function edit ()
    {


    }

    public function update ()
    {


    }


}
