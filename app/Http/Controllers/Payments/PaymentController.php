<?php /** @noinspection ALL */

namespace App\Http\Controllers\Payments;

use App\Helper\helper;
use App\Http\Controllers\Controller;
use App\Mail\PaymentMail;
use App\Models\Municipal;
use App\Municipals;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    private $db_con;

    public function globalConnection($value = 'bcx_zomba_db')
    {
        $municipal_details = Municipal::where('id', Auth::user()->municipal_id)->first();

        if (Auth::user()->access == 2 && Auth::user()->tpin != '-' && Auth::user()->municipal_id != '-') {
            //Database Connection
            $this->db_con = helper::globalMunicipalDbConnection($municipal_details->municipal_db_name);
        }
        else{
            //Database Connection
            $this->db_con = helper::globalMunicipalDbConnection($value);
        }
        return $this->db_con;
    }

    public function payments_information(){
        if (Auth::user()->role_id == 2 && Auth::user()->tpin != '-' && Auth::user()->municipal_id != '-') {
            $sql1 = "SELECT d.entity_id,d.hamlet_id,p.terminal_date as payment_date, p.system_date as paid_date,e.hamlet_name,p.new_licence, p.PRN, p.pay_status,p.reg_status, p.payment_number,p.amount_pay,p.extra_amount, b.descrption_name, b.amount_required_HQ, d.registration_name, d.business_number, a.owner_fullname, CASE WHEN t.area_id = 1 THEN b.amount_required_HQ WHEN t.area_id = 2 THEN b.amount_required_MINOR ELSE NULL END AS charges from tbl_distr_munic_portal_permanent_entity as d INNER JOIN tbl_distr_munic_portal_payment_records as p on p.entity_id=d.entity_id INNER JOIN tbl_distr_munic_portal_owner as a on a.owner_id=d.owner_id INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption as b on b.descr_id=d.descr_id inner join tbl_distr_munic_portal_area_fee as t on t.area_id = d.area_id INNER JOIN tbl_distr_munis_portal_hamlet as e on e.hamlet_id=d.hamlet_id WHERE a.tin_number = ? ORDER BY p.payment_number DESC";
            $payments = $this->globalConnection()->select($sql1, [Auth::user()->tpin]);
        }

        return view('pages.manage.payments',compact('payments'));
    }

    public function download_invoice($entity_id){
        $sql1 = "SELECT d.hamlet_id,p.terminal_date as payment_date, p.system_date as paid_date,e.hamlet_name,p.new_licence, p.PRN, p.pay_status,p.reg_status, p.payment_number,p.amount_pay,p.extra_amount, b.descrption_name, b.amount_required_HQ, d.registration_name, d.business_number, a.owner_fullname, CASE WHEN t.area_id = 1 THEN b.amount_required_HQ WHEN t.area_id = 2 THEN b.amount_required_MINOR ELSE NULL END AS charges from tbl_distr_munic_portal_permanent_entity as d INNER JOIN tbl_distr_munic_portal_payment_records as p on p.entity_id=d.entity_id INNER JOIN tbl_distr_munic_portal_owner as a on a.owner_id=d.owner_id INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption as b on b.descr_id=d.descr_id inner join tbl_distr_munic_portal_area_fee as t on t.area_id = d.area_id INNER JOIN tbl_distr_munis_portal_hamlet as e on e.hamlet_id=d.hamlet_id WHERE d.entity_id = ? ORDER BY p.payment_number DESC";
        $payments = $this->globalConnection()->select($sql1, [$entity_id]);

        $data = [
            'owner_name' => $payments[0]->owner_fullname,
            'business_name' => $payments[0]->descrption_name,
            'business_number' => $payments[0]->business_number,
            'business_licence' => $payments[0]->new_licence,
            'amount' => $payments[0]->charges,
            'paid_amount' => $payments[0]->amount_pay,
            'extra_amount' => $payments[0]->extra_amount,
            'payment_number' => $payments[0]->payment_number,
        ];

        $pdf = PDF::loadView('invoice.payment_invoice', $data);
        return $pdf->stream('invoice--'.date('d-m-Y').'.pdf');
    }

    public function load_payment_graph_data(){
        $databases = Municipal::all();

        $payments = array();
        foreach ($databases as $database) {
            try {
                $sql1 = "SELECT d.hamlet_id,p.terminal_date as payment_date, p.system_date as paid_date,e.hamlet_name,p.new_licence, p.PRN, p.pay_status,p.reg_status, p.payment_number,p.amount_pay,p.extra_amount, b.descrption_name, b.amount_required_HQ, d.registration_name, d.business_number, a.owner_fullname, CASE WHEN t.area_id = 1 THEN b.amount_required_HQ WHEN t.area_id = 2 THEN b.amount_required_MINOR ELSE NULL END AS charges from tbl_distr_munic_portal_permanent_entity as d INNER JOIN tbl_distr_munic_portal_payment_records as p on p.entity_id=d.entity_id INNER JOIN tbl_distr_munic_portal_owner as a on a.owner_id=d.owner_id INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption as b on b.descr_id=d.descr_id inner join tbl_distr_munic_portal_area_fee as t on t.area_id = d.area_id INNER JOIN tbl_distr_munis_portal_hamlet as e on e.hamlet_id=d.hamlet_id ORDER BY p.payment_number DESC";
                array_push($payments, helper::globalMunicipalDbConnection($database->municipal_db_name)->select($sql1));
            }catch (\Exception $e){
                Log::critical('error on graph payment: '.$e);
            }

        }

        return $payments;
    }

    //BusinessLicence
    public function payBusinessLicence(Request $request)
    {

        try{

            $prn = $request->PRN;

            $phone_number = $request->phone_number;

            $client = new Client();

            $api_url = "https://ercis.co.tz/NitelApi/public/api/v1/mno/payment";

            $response = $client->request('POST', $api_url, [
                'body'=>$request
            ]);

            $r['data'] = json_decode($response->getBody());

            return $r;

        }catch (\Exception $e)
        {
            Session::flash('success',"Payment In Progress");
            $this->sendPaymentMail();
            return redirect()->back();

            $response['message']=$e->getMessage();
            $response['status']="fail";
            return response()->json($response,401);
        }
    }

    /*
     * php artisan make:mail PaymentMail --markdown=emails.paymentSendMail

     */
    public function sendPaymentMail()
    {
        $email = 'jamesburetta39@gmail.com';

        $offer = [
            'title' => 'Payment made',
            'url' => 'https://www.remotestack.io'
        ];

        Mail::to($email)->send(new PaymentMail($offer));


    }
}
