<?php

namespace App\Http\Controllers;

use App\Models\Municipal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
            'tpin' => 'required',
            'municipal_id' => 'required',
            'password' => 'required',
        ]);

        try {
            //Verify TPIN
            $response_tpin = checkTpin($request->municipal_id,$request->tpin);

            //Confirm TPIN
            if ($response_tpin != 'success'){
                return response()->json(['errors' => ['error-details' => ['Incorrect TPIN. Confirm TPIN & Municipal and Try Again!']]],422);
            }
            elseif($response_tpin === 'success'){
                //Encrypted Password
                $password = Hash::make($request->password);

                //Load Municipal Details
                $get_municipal = "SELECT * FROM municipals WHERE municipal_db_name = ? LIMIT 1";
                $data = DB::connection('mysql')->select($get_municipal,[$request->municipal_id]);

                //dd($data);
                $query_save = "INSERT INTO users (fullname, email, municipal_id, tpin, password, role_id, access, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                $user_save = DB::connection('mysql')->insert($query_save,[$request->fullname, $request->email, $data[0]->id , $request->tpin, $password, 1, 2, 1]);

                if($user_save){
                    return response()->json(['email' => $request->email,'password' => $request->password]);
                }
            }
        }
        catch (\Exception $e)
        {
            Log::info('Error message', ['context' => $e]);
        }
    }

    public function refreshToken(Request $request)
    {
        session()->regenerate();
        return response()->json(["token"=>csrf_token()],200);
    }
}
