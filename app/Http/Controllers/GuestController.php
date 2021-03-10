<?php

namespace App\Http\Controllers;

use App\Models\Municipal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use \App\Helper\helper;

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
            'phone' => 'required',
            'municipal_id' => 'required',
            'password' => 'required',
        ]);

        try {
            //Verify TPIN
            $response_tpin = helper::checkTpin($request->municipal_id,$request->tpin);

            //Confirm TPIN
            if ($response_tpin != 'success'){
                return response()->json(['errors' => ['error-details' => ['Incorrect TPIN. Confirm TPIN & Municipal and Try Again!']]],422);
            }

            elseif($response_tpin === 'success'){
                $check_for_multiple_tpin = helper::counterTpin($request->municipal_id,$request->tpin);

                if ($check_for_multiple_tpin > 1){
                    return response()->json(['errors' => ['error-details' => ['TPIN Used on multiple users registration. Contact Admin for support!']]],422);
                }else{
                    //Confirm if User With TPIN number already registered in the System
                    $check_users = User::where('tpin',$request->tpin)->count();
                    if ($check_users > 0){
                        return response()->json(['errors' => ['error-details' => ['TPIN Already used on registration. Login or use forgot password to recover Account!']]],422);
                    }else{
                        //Encrypted Password
                        $password = Hash::make($request->password);

                        //Load Municipal Details
                        $get_municipal = Municipal::where('municipal_db_name',$request->municipal_id)->first();

                        //dd($data);
                        //$query_save = "INSERT INTO users (fullname, email, municipal_id, tpin, phone_number, password, role_id, access, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        // $user_save = helper::globalMunicipalDbConnection($request->municipal_id)->insert($, 1, 2, 1]);

                        try{
                            //Save New User Details
                            $save_details = new User();
                            $save_details->fullname = $request->fullname;
                            $save_details->email = $request->email;
                            $save_details->municipal_id = $get_municipal->id;
                            $save_details->tpin = $request->tpin;
                            $save_details->phone_number = $request->phone;
                            $save_details->password = $password;
                            $save_details->role_id =2;
                            $save_details->access = 2;
                            $save_details->status = 1;
                            $save_details->save();

                           return response()->json(['email' => $request->email,'password' => $request->password]);

                        }catch (\Exception $e){
                            Log::critical($e);
                            return response()->json(['errors' => ['error-details' => ['Something Went Wrong. Please Try Again!']]],422);
                        }
                    }



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

    public function siteMap()
    {
        return view('pages.sitemap.view_sitemap');
    }
}
