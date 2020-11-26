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

class BusinessLicenceController extends Controller
{
   private $db_con;

   public function globalConnection()
    {
        $municipal_details = Municipal::where('id', Auth::user()->municipal_id)->first();

        //Database Connection
        Config::set("database.connections." . $municipal_details->municipal_db_name, [
            "driver" => "mysql",
            "port" => "3306",
            "strict" => false,
            "host" => "127.0.0.1",
            "database" => $municipal_details->municipal_db_name,
            "username" => "root",
            "password" => ""
        ]);

        $this->db_con = DB::connection($municipal_details->municipal_db_name);

        return $this->db_con;
    }

   public function renew_licence(){
       $sql = "SELECT * FROM tbl_distr_munis_portal_hamlet";
       $hamlets = $this->globalConnection()->select($sql);

       $sql1 = "SELECT * FROM tbl_distr_munic_portal_permanent_levy";
       $permanent_levy = $this->globalConnection()->select($sql1);

       $sql_data ="SELECT * FROM tbl_distr_munic_portal_area_fee";
       $registered_area = $this->globalConnection()->select($sql_data);

       return view('pages.manage.renew_licence',compact('hamlets','permanent_levy','registered_area'));
   }

   public function request_business_licence(Request $request){
       $this->validate($request, [
           'owner_name' => 'required',
           'manager_name' => 'required',
           'business_name' => 'required',
           'business_number' => 'required',
           'hamlet' => 'required',
           'permanent_levy' => 'required',
           'permanent_levy_channel' => 'required',
           'registered_area' => 'required',
       ]);

       //Get Owner Details
       $sqli="SELECT * FROM tbl_distr_munic_portal_owner WHERE tin_number = ?";
       $data = $this->globalConnection()->select($sqli,[Auth::user()->tpin]);

       //Store owner New Business
       $sql = "INSERT INTO tbl_distr_munic_portal_permanent_entity
		(owner_id, descr_id, date_register, latitude, longitude, hamlet_id, area_id, registration_name, manager_name, image, business_number, block, house_no, account_status)
		VALUES
		(?, ?, NOW(),0.00000000,0.00000000, ?, ?, ?, ?,'masasi.png', ?, ?, ?,0)";
       $save_levy = $this->globalConnection()->insert($sql,[$data[0]->owner_id,$request->permanent_levy_channel,$request->hamlet,$request->registered_area,$request->owner_name,$request->manager_name,$request->business_number,$request->block,$request->house_number]);

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
