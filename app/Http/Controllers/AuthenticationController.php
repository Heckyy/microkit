<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function login()
    {

        return response()->view('authentication.login');
    }

    public function register()
    {
    }
}
