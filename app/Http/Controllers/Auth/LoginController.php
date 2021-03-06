<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MongoDB\Driver\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function sendLoginResponse(Request $request)
    {
        try {
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);

            $check_user = User::where('email', $request->email)->count();

            if ($check_user > 0) {
                $user_status = User::where('email', $request->email)->first();
                if ($user_status->status == 0) {
                    $this->guard()->logout();

                    $request->session()->invalidate();

                    $request->session()->regenerateToken();

                    return response()->json(['errors' => ['error-details' => ['Your Account is Deactivated']]], 422);
                }
            }else{
                Session::flash('message', "Something went wrong");

                return redirect()->route("auth_login");
            }

//        if($this->guard()->user()->role['role_name'] == 'admin'){
            return redirect()->route("admin_dashboard");
//        }
        }catch (\Exception $e)
        {
            Log::info('message',['Errors'=>$e->getMessage()]);

            Session::flash('message', $e->getMessage());

            return redirect()->route("auth_login");
        }
    }

    public function apiLogin(Request $request)
    {
    }
}
