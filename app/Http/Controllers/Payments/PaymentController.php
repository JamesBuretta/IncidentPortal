<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Municipal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
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

    public function payments_information(){
        $sql1="SELECT d.hamlet_id,e.hamlet_name,p.new_licence, p.PRN, p.pay_status,p.reg_status, p.payment_number,p.amount_pay,p.extra_amount, b.descrption_name, b.amount_required_HQ, d.registration_name, d.business_number, a.owner_fullname, CASE WHEN t.area_id = 1 THEN b.amount_required_HQ WHEN t.area_id = 2 THEN b.amount_required_MINOR ELSE NULL END AS charges from tbl_distr_munic_portal_permanent_entity as d INNER JOIN tbl_distr_munic_portal_payment_records as p on p.entity_id=d.entity_id INNER JOIN tbl_distr_munic_portal_owner as a on a.owner_id=d.owner_id INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption as b on b.descr_id=d.descr_id inner join tbl_distr_munic_portal_area_fee as t on t.area_id = d.area_id INNER JOIN tbl_distr_munis_portal_hamlet as e on e.hamlet_id=d.hamlet_id WHERE a.tin_number = ? ORDER BY p.payment_number DESC";
        $payments = $this->globalConnection()->select($sql1,[Auth::user()->tpin]);

        return view('pages.manage.payments',compact('payments'));
    }
}
