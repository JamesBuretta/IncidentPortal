<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function auth_login(){
        return view('auth.login');
    }
    public function password_reset(){
        return view('auth.forgot_password');
    }
    public function refreshToken(Request $request)
    {
        session()->regenerate();
        return response()->json([
            "token"=>csrf_token()],
            200);

    }
}
