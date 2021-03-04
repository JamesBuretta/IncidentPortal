<?php

namespace App\Http\Controllers\Licence;

use App\Http\Controllers\Controller;
use App\Models\Municipal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use \App\Helper\Helper;

class BusinessLicenceController extends Controller
{
   private $db_con;

   public function globalConnection()
    {
        $municipal_details = Municipal::where('id', Auth::user()->municipal_id)->first();

        //Database Connection
        $this->db_con = Helper::globalMunicipalDbConnection($municipal_details->municipal_db_name);

        return $this->db_con;
    }

   public function renew_licence(){
       $available_details = 0;

       if (Auth::user()->access == 2 && Auth::user()->tpin != '-' && Auth::user()->municipal_id != '-') {
           $available_details = 1;

           $sql = "SELECT * FROM tbl_distr_munis_portal_hamlet";
           $hamlets = $this->globalConnection()->select($sql);

           $sql1 = "SELECT * FROM tbl_distr_munic_portal_permanent_levy_descrption";
           $permanent_levy_source = $this->globalConnection()->select($sql1);

           $sql_data = "SELECT * FROM tbl_distr_munic_portal_area_fee";
           $registered_area = $this->globalConnection()->select($sql_data);

           return view('pages.manage.renew_licence',compact('hamlets','permanent_levy_source','registered_area','available_details'));
       }else{
           return view('pages.manage.renew_licence',compact('available_details'));
       }
   }

   public function request_business_licence(Request $request){
       $this->validate($request, [
           'owner_name' => 'required',
           'manager_name' => 'required',
           'business_name' => 'required',
           'business_number' => 'required',
           'hamlet' => 'required',
           'business_type' => 'required',
           'registered_area' => 'required',
       ]);

       //Get Owner Details
       $sqli="SELECT * FROM tbl_distr_munic_portal_owner WHERE tin_number = ?";
       $data = $this->globalConnection()->select($sqli,[Auth::user()->tpin]);

//       //Get Permanent Levy
//       $sql11 = "SELECT type_id FROM tbl_distr_munic_portal_permanent_levy_descrption WHERE descr_id = ? LIMIT 1";
//       $permanent_levy = $this->globalConnection()->select($sql11,[$request->business_type]);
//
//       dd($permanent_levy[0]->type_id);

       //Store owner New Business
       $sql = "INSERT INTO tbl_distr_munic_portal_permanent_entity
		(owner_id, descr_id, date_register, latitude, longitude, hamlet_id, area_id, registration_name, manager_name, image, business_number, block, house_no, account_status)
		VALUES
		(?, ?, NOW(),0.00000000,0.00000000, ?, ?, ?, ?,'masasi.png', ?, ?, ?,0)";
       $save_levy = $this->globalConnection()->insert($sql,[$data[0]->owner_id,$request->business_type,$request->hamlet,$request->registered_area,$request->owner_name,$request->manager_name,$request->business_number,$request->block,$request->house_number]);

       if ($save_levy){
           Session::flash('success','New Business Licence Successfully Requested');
       }else{
           Session::flash('fail','Something went wrong. Try Again!');
       }

       return redirect()->back();
    }

    public function get_levy_channel($levy_id){
        $sqli="SELECT * FROM tbl_distr_munic_portal_permanent_levy_descrption WHERE type_id = ?";
        $data = $this->globalConnection()->select($sqli,[$levy_id]);

        return response()->json(['levy_channels' => $data]);
    }
}
