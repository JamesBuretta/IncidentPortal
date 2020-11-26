<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class GetPaymentRefController extends Controller
{
    private $db;

    public function __construct()
    {
        Config::set("database.connections.zomba_db", [
            "driver" => "mysql",
            "port" => "3306",
            "strict" => false,
            "host" => "127.0.0.1",
            "database" => "zomba_db",
            "username" => "root",
            "password" => "BCXTanzania1234567890"
        ]);

        $this->db = DB::connection('zomba_db');
    }

    //Get Payment reference number
    public function getPaymentReferenceNumber(Request $request)
    {
        $sql = "INSERT INTO tbl_distr_munic_portal_permanent_entity
		(owner_id, descr_id, date_register, hamlet_id,area_id, registration_name,manager_name, image, latitude,longitude,business_number,block,house_no)
		VALUES
		($request->owner, $request->description, NOW(), $request->villa,$request->area, $request->rname,$request->managername ,'masasi.png', $request->latitude, $request->longitude, $request->businessid, $request->block, $request->house_no)";

        try{

            $result = $this->db->getPdo($sql);

            if($result->execute())
            {
                $id= $result->lastInsertedId();
                $this->PaymentRecords($id);
            }

        }catch (\Exception $e)
        {
        }
    }

    //insert payment table
    public function PaymentRecords($ID)
    {
        $parenu=$this->prnGenereted();
        $receipt=$this->formatedReceipt();
        $sql="SELECT a.entity_id,a.descr_id,a.room_no,b.descrption_name,b.extra_amount,c.email,c.owner_fullname,c.phone_number,CASE WHEN a.area_id = 1 THEN b.amount_required_HQ WHEN a.area_id = 2 THEN b.amount_required_MINOR ELSE NULL END AS charges FROM tbl_distr_munic_portal_permanent_entity as a INNER JOIN tbl_distr_munic_portal_permanent_levy_descrption as b on b.descr_id=a.descr_id inner join tbl_distr_munic_portal_owner as c on c.owner_id=a.owner_id where a.entity_id=:id";
        try
        {
            $result=$this->db->select($sql);

            foreach($result as $row)
            {
                //$row['amount_worth']
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
        $amount=$row['extra_amount']*$row['room_no'];
        $cash=$row['charges'];
        $new_licence = $this->formatedLicence();

        $sql="insert into tbl_distr_munic_portal_payment_records
		(PRN, entity_id, pay_status, reg_status, notification, amount_pay, system_date, terminal_date,business_number,receipt,extra_amount,new_licence)
		values (:PRN, :entity, '0', '1' ,0, :cash, NOW(), NOW(), 0, :receipt, :amount, :new_licence)";
        try
        {
            $result=$this->db->prepare($sql);
            $result->bindParam(":entity",$ID);
            $result->bindParam(":PRN",$parenu);
            $result->bindParam(":receipt",$receipt);
            $result->bindParam(":amount",$amount);
            $result->bindParam(":cash",$cash);
            $result->bindParam(":new_licence",$new_licence);
            $result->execute();
            //$this->sendsms($owner, $phone, $parenu, $descrption,$cash,$email);
            $_SESSION['message'] = $this->div('success','',$this->lang['done']);
            header('location: ../portal.php?page=list-view&add=entity-details');
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
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
        $sql="INSERT INTO tbl_distr_munis_portal_receipt_generation (day_time) VALUES (:datetime)";
        try
        {
            $result=$this->db->insert($sql);
            $result->bindParam(":datetime", $x);
            if($result->execute())
            {
                $id= $this->db->lastInsertId();
                $output = $this->receiptNumber($id,6)."".$x;
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

    public function verifyTpinNumber()
    {
        $sql = "SELECT tin_number FROM tbl_distr_munic_portal_owner WHERE tin_number=?";

        try{

        }catch (\Exception $e)
        {

        }
    }
}
