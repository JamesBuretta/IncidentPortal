<?php /** @noinspection ALL */

namespace App\Http\Controllers\SharedFolder;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
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
        $this->db_con = Helper::globalMunicipalDbConnection($municipal_details->municipal_db_name);

        return $this->db_con;
    }

    public function dashboard(){
        $total_users = User::all()->count();
        $total_municipals = Municipal::all()->count();

        //Get Total Business & Payment's Details
        $my_business = 0;
        $my_payments = 0;
        if (Auth::user()->access == 2 && Auth::user()->tpin != '-' && Auth::user()->municipal_id != '-'){
            //My Payment's
            $sql1="SELECT d.hamlet_id,p.terminal_date as payment_date, p.system_date as paid_date,e.hamlet_name,p.new_licence, p.PRN, p.pay_status,p.reg_status, p.payment_number,p.amount_pay,p.extra_amount, b.descrption_name, b.amount_required_HQ, d.registration_name, d.business_number, a.owner_fullname, CASE WHEN t.area_id = 1 THEN b.amount_required_HQ WHEN t.area_id = 2 THEN b.amount_required_MINOR ELSE NULL END AS charges from tbl_distr_munic_portal_permanent_entity as d INNER JOIN tbl_distr_munic_portal_payment_records as p on p.entity_id=d.entity_id INNER JOIN tbl_distr_munic_portal_owner as a on a.owner_id=d.owner_id INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption as b on b.descr_id=d.descr_id inner join tbl_distr_munic_portal_area_fee as t on t.area_id = d.area_id INNER JOIN tbl_distr_munis_portal_hamlet as e on e.hamlet_id=d.hamlet_id WHERE a.tin_number = ? ORDER BY p.payment_number DESC";
            $payments = $this->globalConnection()->select($sql1,[Auth::user()->tpin]);
            $my_payments = sizeof($payments);

            //My Business
            $get_owner_details = 'SELECT * FROM tbl_distr_munic_portal_owner WHERE tin_number = ?';
            $data = $this->globalConnection()->select($get_owner_details,[Auth::user()->tpin]);

            //Retrieve Business Details
            $get_owner_business_details = 'SELECT COUNT(a.business_number) as my_business FROM tbl_distr_munic_portal_permanent_entity AS a
                                           INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption AS b ON a.descr_id = b.descr_id
                                           INNER JOIN tbl_distr_munic_portal_area_fee AS c ON c.area_id = a.area_id
                                           WHERE owner_id = ?';

            $businesses = $this->globalConnection()->select($get_owner_business_details,[$data[0]->owner_id]);

            $my_business = $businesses[0]->my_business;
        }

        return view('pages.index',compact('total_users','total_municipals','my_payments','my_business'));
    }

    public function profile(){
        $user_roles = Role::all();
        $municipals = Municipal::all();

        //Check Business Details
        $business_details = array();
        if (Auth::user()->access == 2 && Auth::user()->tpin != '-' && Auth::user()->municipal_id != '-'){

            $get_owner_details = 'SELECT * FROM tbl_distr_munic_portal_owner WHERE tin_number = ?';
            $data = $this->globalConnection()->select($get_owner_details,[Auth::user()->tpin]);

           // dd($data);
            //Retrieve Business Details
            $get_owner_business_details = 'SELECT a.business_number,a.account_status,b.descrption_name,c.main_category
                                           FROM tbl_distr_munic_portal_permanent_entity AS a
                                           INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption AS b ON a.descr_id = b.descr_id
                                           INNER JOIN tbl_distr_munic_portal_area_fee AS c ON c.area_id = a.area_id
                                           WHERE a.owner_id = ?';

            $businesses = $this->globalConnection()->select($get_owner_business_details,[$data[0]->owner_id]);

            $business_details = $businesses;
        }

        return view('pages.profile',compact('user_roles','municipals','business_details'));
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
            if (Hash::check($request->old_password,Auth::user()->password)) {
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
