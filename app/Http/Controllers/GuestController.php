<?php

namespace App\Http\Controllers;

use App\Models\Municipal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class GuestController extends Controller
{
    public function auth_login(){
        return view('auth.login');
    }
    public function register_page(){
        $municipals = Municipal::all();
        return view('auth.register',compact('municipals'));
    }
    public function password_reset(){
        return view('auth.forgot_password');
    }
    public function create_account(Request $request){
        $this->validate($request, [
            'email' => 'required|unique:users',
            'fullname' => 'required',
            'municipal_id' => 'required',
            'password' => 'required',
        ]);

        $save_new_user = new User();
        $save_new_user->name = $request->fullname;
        $save_new_user->email = $request->email;
        $save_new_user->municipal_id = $request->municipal_id;
        $save_new_user->password = Hash::make($request->password);
        $save_new_user->role_id = 1;
        $save_new_user->access = 2;
        $save_new_user->status = 1;
        $save_new_user->save();

        return response()->json(['email' => $request->email,'password' => $request->password]);
    }
    public function refreshToken(Request $request)
    {
        session()->regenerate();
        return response()->json([
            "token"=>csrf_token()],
            200);
    }
}
