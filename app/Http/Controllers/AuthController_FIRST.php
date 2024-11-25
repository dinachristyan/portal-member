<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Display login page
    public function login()
    {
        return view('auth.login');
    }

    // Display forgot-password page
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    // Display register page
    public function register()
    {
        return view('auth.register');
    }
}
