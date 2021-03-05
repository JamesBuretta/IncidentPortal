<?php

namespace App\Http\Controllers\Business;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Municipal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    private $db_con;

    public function globalConnection()
    {
        $municipal_details = Municipal::where('id', Auth::user()->municipal_id)->first();

        //Database Connection
        $this->db_con = Helper::globalMunicipalDbConnection($municipal_details->municipal_db_name);

        return $this->db_con;
    }

    public function view_business()
    {
        //Check Business Details
        $business_details = array();

        if (Auth::user()->access == 2 && Auth::user()->tpin != '-' && Auth::user()->municipal_id != '-') {

            $get_owner_details = 'SELECT * FROM tbl_distr_munic_portal_owner WHERE tin_number = ?';
            $data = $this->globalConnection()->select($get_owner_details, [Auth::user()->tpin]);

            // dd($data);
            //Retrieve Business Details
            $get_owner_business_details = 'SELECT a.entity_id,a.business_number,a.account_status,b.descrption_name,c.main_category
                                           FROM tbl_distr_munic_portal_permanent_entity AS a
                                           INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption AS b ON a.descr_id = b.descr_id
                                           INNER JOIN tbl_distr_munic_portal_area_fee AS c ON c.area_id = a.area_id
                                           WHERE a.owner_id = ?';

            $businesses = $this->globalConnection()->select($get_owner_business_details, [$data[0]->owner_id]);

            $business_details = $businesses;

        }
        return view('pages.business.view_all',compact('business_details'));
    }

    public function view_single_business($business_id){
        $get_owner_details = 'SELECT * FROM tbl_distr_munic_portal_owner WHERE tin_number = ?';
        $data = $this->globalConnection()->select($get_owner_details, [Auth::user()->tpin]);

        // dd($data);
        //Retrieve Business Details
        $get_owner_business_details = 'SELECT a.*,d.*,b.descrption_name,c.main_category
                                           FROM tbl_distr_munic_portal_permanent_entity AS a
                                           INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption AS b ON a.descr_id = b.descr_id
                                           INNER JOIN tbl_distr_munic_portal_owner as d on a.owner_id=d.owner_id
                                           INNER JOIN tbl_distr_munic_portal_area_fee AS c ON c.area_id = a.area_id
                                           WHERE a.entity_id = ?';

        $businesses = $this->globalConnection()->select($get_owner_business_details, [$business_id]);

        //dd($businesses);
        $business_details = $businesses;

       // dd($business_details);
        return view('pages.business.single_view',compact('business_details'));
    }
}
