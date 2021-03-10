<?php

namespace App\Http\Controllers\Licence;

use App\Helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Municipal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PRNRequestController extends Controller
{
    private $db_con;

    public function globalConnection()
    {
        $municipal_details = Municipal::where('id', Auth::user()->municipal_id)->first();

        //Database Connection
        $this->db_con = helper::globalMunicipalDbConnection($municipal_details->municipal_db_name);

        return $this->db_con;
    }

   public function request_prn(){
       //Check Business Details
       $business_details = array();
       $available_details = 0;
       if (Auth::user()->access == 2 && Auth::user()->tpin != '-' && Auth::user()->municipal_id != '-') {
           $available_details = 1;
           $get_owner_details = 'SELECT * FROM tbl_distr_munic_portal_owner WHERE tin_number = ?';
           $data = $this->globalConnection()->select($get_owner_details, [Auth::user()->tpin]);

           //Retrieve Business Details
           $get_owner_business_details = 'SELECT a.entity_id,a.account_status,a.business_number,a.registration_name,b.descrption_name,c.main_category FROM tbl_distr_munic_portal_permanent_entity AS a
                                           INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption AS b ON a.descr_id = b.descr_id
                                           INNER JOIN tbl_distr_munic_portal_area_fee AS c ON c.area_id = a.area_id
                                           WHERE owner_id = ?';

           $businesses = $this->globalConnection()->select($get_owner_business_details, [$data[0]->owner_id]);

           //Compute Business Payment
           $temp_container = array();
           foreach ($businesses as $bs){
               //Payment Check Variable
               $payment_status = 'un-paid';
               $prn = '';
               $receipt = '';

               //Check Payment Status
               $chk_payment = 'SELECT count(*) FROM tbl_distr_munic_portal_payment_records WHERE entity_id = ?';
               $results = $this->globalConnection()->select($chk_payment, [$bs->entity_id]);

               if ($results > 0) {
                   $chk_payment = 'SELECT * FROM tbl_distr_munic_portal_payment_records WHERE entity_id = ?';
                   $res = $this->globalConnection()->select($chk_payment, [$bs->entity_id]);

                   foreach ($res as $sq){
                       $db_date = Carbon::parse($sq->terminal_date)->format('Y');

                       if (date("Y") == $db_date && $sq->pay_status == 1) {
                           $payment_status = 'paid';
                           $receipt = $sq->receipt;
                       }

                       if (date("Y") == $db_date) {
                           $prn = $sq->PRN;
                       }
                   }
               }

               $temp_container[] = [
                   'entity' => Crypt::encrypt($bs->entity_id),
                   'entity_id' => $bs->entity_id,
                   'account_status' => $bs->account_status,
                   'payment_status' => $payment_status,
                   'PRN' => ($prn == '') ? '-' : $prn,
                   'receipt' => ($receipt == '') ? '-' : $receipt,
                   'business_number' => $bs->business_number,
                   'registration_name' => $bs->registration_name,
                   'description_name' => $bs->descrption_name,
                   'location' => $bs->main_category,
               ];

           }

           $business_details = $temp_container;

           return view('pages.manage.request_prn',compact('business_details','available_details'));
       }else{
           return view('pages.manage.request_prn',compact('available_details'));
       }
   }

   public function business_request_prn(Request $request){
       //Decode Data
       $entity_id = Crypt::decrypt($request->entity);

       //Generate PRN
       $new_prn = $this->prnGenereted();

       //Generate Receipt Number
       $receipt = $this->formatedReceipt();

       //Generate Licence
       $new_licence = $this->formatedLicence();

       //Compute Charges
       $sql="SELECT a.entity_id,a.descr_id,a.room_no,b.descrption_name,b.extra_amount,c.email,c.owner_fullname,c.phone_number,CASE WHEN a.area_id = 1 THEN b.amount_required_HQ WHEN a.area_id = 2 THEN b.amount_required_MINOR ELSE NULL END AS charges FROM tbl_distr_munic_portal_permanent_entity as a INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption as b on b.descr_id=a.descr_id inner join tbl_distr_munic_portal_owner as c on c.owner_id=a.owner_id where a.entity_id=:id";
       $results_charges = $this->globalConnection()->select($sql,[$entity_id]);
       $amount = (int)$results_charges[0]->extra_amount * (int)$results_charges[0]->room_no;
       $cash = $results_charges[0]->charges;

       //Save New Payment Request
       $chk_payment = "INSERT INTO tbl_distr_munic_portal_payment_records
                       (PRN, entity_id, pay_status, reg_status, notification, amount_pay, system_date, terminal_date, business_number, receipt, extra_amount, new_licence) VALUES
                       (?,?,'0','1',0,?,?,?,0,?,?,?)";
       $results = $this->globalConnection()->insert($chk_payment, [$new_prn,$entity_id,$cash,now(),now(),$receipt,$amount,$new_licence]);

      return response()->json(['success' => 'PRN Successfully Requested'],200);
   }

    //generation of payment reference number
    public function prnGenereted($length = 10)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //Formatted receipt
    public function formatedReceipt()
    {
        $x = date("md");
        $sql="INSERT INTO tbl_distr_munis_portal_receipt_generation (day_time) VALUES (?)";
        try
        {
            $results = $this->globalConnection()->insert($sql, [$x]);

            if($results)
            {
                $sqli="SELECT `receipt-ID` as id,day_time FROM tbl_distr_munis_portal_receipt_generation ORDER BY `receipt-ID` DESC LIMIT 1";
                $data = $this->globalConnection()->select($sqli);

                $output = $this->receiptNumber($data[0]->id,6)."".$x;
            }
        }
        catch(PDOException $e)
        {
            $e->getMessage();
        }

        return $output;
    }

    //receipt generate
    public function receiptNumber($number,$add_nol)
    {
        while (strlen($number)<$add_nol) {
            $number = "0".$number;
        }
        return $number;
    }

    //licence Generate
    public function formatedLicence()
    {
        $x = date("md");
        $sql="INSERT INTO tbl_distr_munis_portal_licence_generation (day_time) VALUES (?)";
        try
        {
            $data = $this->globalConnection()->insert($sql, [$x]);

            if($data)
            {
                $sqli="SELECT id,day_time FROM tbl_distr_munis_portal_licence_generation ORDER BY id DESC LIMIT 1";
                $data = $this->globalConnection()->select($sqli);

                $output = $x."".$this->receiptNumber($data[0]->id,5);
            }
        }
        catch(PDOException $e)
        {
            $e->getMessage();
        }

        return $output;
    }
}
