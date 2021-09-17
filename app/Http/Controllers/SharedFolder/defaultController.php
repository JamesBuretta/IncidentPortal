<?php /** @noinspection ALL */

namespace App\Http\Controllers\SharedFolder;

use App\Helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\Municipal;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class defaultController extends Controller
{
    private $db_con;

    public function globalConnection()
    {
        $municipal_details = Municipal::where('id', Auth::user()->municipal_id)->first();

        //Database Connection
        $this->db_con = helper::globalMunicipalDbConnection($municipal_details->municipal_db_name);

        return $this->db_con;
    }

    public function dashboard(){

        try{

        $inprogress = count(Incident::where('status_id','1')->get());
        $closed = count(Incident::where('status_id','2')->get());
        $cancelled = count(Incident::where('status_id','3')->get());
        $assigned = count(Incident::where('status_id','4')->get());

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
        }
        catch (\Exception $e)
        {
            Log::info('message',['Dashboard'=>$e->getMessage()]);
        }
    }

    public function profile(){
        $user_roles = Role::all();

        $incidents = Incident::where('assigned_id',Auth::id())->get();

        return view('pages.profile',compact('user_roles','incidents'));
    }

    public function update_profile(Request $request,$user_id){
        if($request->hasfile('profile'))
        {
            $this->validate($request, [
                'email' => 'required',
                'fullname' => 'required',
                'phone_number' => 'required',
                'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            ]);
        }
        else{
            $this->validate($request, [
                'email' => 'required',
                'fullname' => 'required',
                'phone_number' => 'required',
            ]);
        }


        $update_user = User::where('id',$user_id)->first();
        $update_user->fullname = $request->fullname;
        $update_user->phone_number = $request->phone_number;
        $update_user->email = $request->email;
        if($request->hasfile('profile'))
        {
            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move(public_path('images/profiles/'), $filename);

            $update_user->profile = $filename;
        }

        $update_user->save();

        Session::flash('success','User Profile Updated Successfully');
        return redirect()->back();
    }

    public function update_credentials(Request $request,$user_id){
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required',
        ]);

        if ($request->confirm_new_password === $request->new_password) {
            if (Hash::check($request->old_password,Auth::password)) {
                $db = User::where('id', Auth::user()->id)->update([
                    'password' => bcrypt($request->new_password)
                ]);
                if ($db == true) {
                    Session::flash('success','Credentials Updated!');
                } else {
                    Session::flash('fail','No change was made!');
                }
            }
            else{
                Session::flash('fail','Password is incorrect!');
            }
        }
        else{
            Session::flash('fail','New and Confirm Password do not match!');
        }

        return redirect()->back();
    }
}
