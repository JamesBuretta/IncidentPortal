<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Municipal;
use App\Models\Role;
use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $roles = Role::all();
        $stations = Station::all();
        return view('auth.register',compact('municipals','roles','stations'));
    }

    public function password_reset(){
        return view('auth.forgot_password');
    }

    public function login(Request $request)
    {
        try {

            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);


            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $inprogress = count(Incident::where('status_id','1')->get());
                $closed = count(Incident::where('status_id','2')->get());
                $cancelled = count(Incident::where('status_id','3')->get());
                $assigned = count(Incident::where('status_id','1')->get());


                $data_sets= DB::select("
        SELECT
        COUNT(*) as count,
        DATE_FORMAT(created_datetime, '%Y-%m-%d') as date
        FROM
        incidents_tracker
        GROUP BY DATE_FORMAT(created_datetime, '%Y-%m-%d');
        ");



                $result[] = ['Date','Incidents'];
                foreach ($data_sets as $key => $value) {
                    $result[++$key] = [$value->date, (int)$value->count];
                }
                $incidents_total_daily = json_encode($result);


                return view('pages.index',compact('inprogress','closed','cancelled','assigned','incidents_total_daily'));
            } else{
                $request->session()->flash('message', 'Oops something went wrong');

                return redirect()->route("login");
            }
        }
        catch(\Exception $e){

            Log::error("message",['LoginRequest'=>$request,'Error'=>$e->getMessage()]);

            $request->session()->flash('message', $e->getMessage());

            return redirect()->route("login");
        }
    }

    public function create_account(Request $request){
        $this->validate($request, [
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'station_id' => ['required'],
            'role_id' => ['required']
        ]);

        try {
                        //Encrypted Password
                        $password = Hash::make($request->password);

                        try{
                            //Save New User Details
                            $save_details = new User();
                            $save_details->fullname = $request->fullname;
                            $save_details->email = $request->email;
                            $save_details->phone_number = $request->phone;
                            $save_details->password = $password;
                            $save_details->station_id = $request->station_id;
                            $save_details->role_id =2;
                            $save_details->access = 2;
                            $save_details->status = 1;
                            $save_details->save();

                           return response()->json(['email' => $request->email,'password' => $request->password]);

                        }catch (\Exception $e){
                            Log::critical($e);

                            return response()->json(['errors' => ['error-details' => [$e->getMessage()]]],422);
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
