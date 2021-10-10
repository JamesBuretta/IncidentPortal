<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Companies;
use App\Models\Impact;
use App\Models\Incident;
use App\Models\IncidentTracker;
use App\Models\MenuAccess;
use App\Models\Priority;
use App\Models\Role;
use App\Models\Station;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;

class ApiController extends Controller
{
    public function login(){
        try {
            if (Auth::attempt(['phone_number' => request('phone_number'), 'password' => request('password')])) {
                $user = Auth::user();

                $phone_number =  User::where('id', $user->id)->select('phone_number')->get()[0];

                if($phone_number->phone_number!=request('phone_number'))
                {
                    return response()->json(['status' => 'fail', 'message' => 'Phone number does not exist'], 200);
                }

                $userDetails = User::where('phone_number',request('phone_number'))->get();

                $impacts = Impact::all();
                $priorities = Priority::all();
                $status = Status::all();
                $companies = Companies::all();
                $stations = Station::where("company_id",$userDetails[0]->company_id)->get();
                $roles = Role::all();


                $data = array();

                $data['impacts']=$impacts;
                $data['priorities']=$priorities;
                $data['status']=$status;
                $data['stations']=$stations;
                $data['companies']=$companies;
                $data['roles']=$roles;



                $response['userDetails'] = $userDetails;
                $response['company_name'] = $userDetails[0]->companies['name'];
                $response['status'] = 'success';
                $response['message'] = 'Authorized user';
                $response['token'] = $user->createToken('MyApp')->accessToken;
                $response['systemData']=$data;

                return $response;

            } else {

                return response()->json(['status' => 'fail', 'message' => 'Incorrect Phone number or Password'], 200);
            }
        }catch (\Exception $e)
        {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()], 200);
        }
    }

    public function closeIncidentSms($request,$incident_ticket)
    {
        $to = $this->add_prefix($request['phone_number']);
        $message = "Incident with ticket ID ".$incident_ticket." has been closed!";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.evancejaye.com/sms/index.php?message='.urlencode($message).'&to='.$to,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        Log::info("SMS",['message'=>$response]);
    }

    public function multipleSms($request)
    {
        $incident = Incident::where('id',$request->id)->get()[0];
        $users = User::where('role_id','1')->orWhere('id',$incident->caller_id)->get();

        foreach($users as $user)
        {
            $this->closeIncidentSms($user,$incident->incident_ticket);
        }

        $response = array("message"=>"All Sms Were Sent");
    }

    public function incidents(Request $request)
    {

        try {
            $sql="SELECT incidents_tracker.id,created_datetime,subject,description,A.fullname as caller, B.fullname as assigned , C.name as impact, D.name as status, E.name as priority,
       F.name as station_name

            FROM incidents_tracker

                INNER JOIN users as A on incidents_tracker.caller_id=A.id
                INNER JOIN users as B on incidents_tracker.assigned_id=B.id
                INNER JOIN impact as C on incidents_tracker.impact_id=C.id
                INNER JOIN status as D on incidents_tracker.status_id=D.id
                INNER JOIN priorities as E on incidents_tracker.priority_id=E.id
                INNER JOIN stations as F on incidents_tracker.station_id=F.id
            ORDER BY incidents_tracker.id DESC
            ";

            $incidents = DB::select(DB::raw($sql));

            return $incidents;
        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']=$e->getMessage();

            return $response;
        }

    }

    public function retrieveIncident(Request $request)
    {

        try {
            $sql="SELECT incidents_tracker.id,created_datetime,subject,description,A.fullname as caller, B.fullname as assigned , C.name as impact, D.name as status, E.name as priority,
       F.name as station_name

            FROM incidents_tracker

                INNER JOIN users as A on incidents_tracker.caller_id=A.id
                INNER JOIN users as B on incidents_tracker.assigned_id=B.id
                INNER JOIN impact as C on incidents_tracker.impact_id=C.id
                INNER JOIN status as D on incidents_tracker.status_id=D.id
                INNER JOIN priorities as E on incidents_tracker.priority_id=E.id
                INNER JOIN stations as F on incidents_tracker.station_id=F.id
            WHERE incidents_tracker.id=".$request->id
            ;

            $incidents = DB::select(DB::raw($sql));

            return $incidents;
        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']=$e->getMessage();

            return $response;
        }

    }

    public function incidentsDashboard(Request $request)
    {

        try {

            $new = Incident::where('status_id',"1")->where("assigned_id",$request->assigned_id)->count();
            $closed = Incident::where('status_id',"2")->where("assigned_id",$request->assigned_id)->count();
            $cancelled = Incident::where('status_id',"3")->where("assigned_id",$request->assigned_id)->count();
            $inprogres = Incident::where('status_id',"4")->where("assigned_id",$request->assigned_id)->count();
            $approved = Incident::where('status_id',"5")->where("assigned_id",$request->assigned_id)->count();
            $assigned = Incident::where('status_id',"6")->where("assigned_id",$request->assigned_id)->count();

            $data = array(
                "open"=>$new,
                "closed"=>$closed,
                "cancelled"=>$cancelled,
                "inprogress"=>$inprogres,
                "approved"=>$approved,
                "assiged"=>$assigned);

            return $data;

        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']=$e->getMessage();

            return $response;
        }

    }

    public function incidentsByCompanyId(Request $request)
    {

        try {

            $new = Incident::where('status_id',"1")->where("company_id",$request->company_id)->count();
            $closed = Incident::where('status_id',"2")->where("company_id",$request->company_id)->count();
            $cancelled = Incident::where('status_id',"3")->where("company_id",$request->company_id)->count();
            $inprogres = Incident::where('status_id',"4")->where("company_id",$request->company_id)->count();
            $approved = Incident::where('status_id',"5")->where("company_id",$request->company_id)->count();
            $assigned = Incident::where('status_id',"6")->where("company_id",$request->company_id)->count();

            $data = array(
                "open"=>$new,
                "closed"=>$closed,
                "cancelled"=>$cancelled,
                "inprogress"=>$inprogres,
                "approved"=>$approved,
                "assiged"=>$assigned);

            return $data;

        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']=$e->getMessage();

            return $response;
        }

    }

    public function incidentsByCreatedById(Request $request)
    {
        try {
            $sql="SELECT incidents_tracker.id,created_datetime,subject,description,A.fullname as caller, B.fullname as assigned , C.name as impact, D.name as status, E.name as priority,
            F.name as station_name

            FROM incidents_tracker

                INNER JOIN users as A on incidents_tracker.caller_id=A.id
                LEFT JOIN users as B on incidents_tracker.assigned_id=B.id
                INNER JOIN impact as C on incidents_tracker.impact_id=C.id
                INNER JOIN status as D on incidents_tracker.status_id=D.id
                INNER JOIN priorities as E on incidents_tracker.priority_id=E.id
                LEFT JOIN stations as F on incidents_tracker.station_id=F.id
            WHERE caller_id=".$request->caller_id."
            ORDER BY incidents_tracker.id DESC
            ";

            $incidents = DB::select(DB::raw($sql));
            $ret = array();
            if(count($incidents) > 0){
                $ret['status'] = "success";
                $ret["message"] = "Incidents retrieved successfully.";
                $ret["incidents"][] = $incidents;
            }else{
                $ret['status'] = "fail";
                $ret["message"] = "Incidents retrieved un successfully.";
            }
            return $ret;
        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']=$e->getMessage();

            return $response;
        }
    }

    public function incidentsByAssignedById(Request $request)
    {
        try {
            $sql="SELECT incidents_tracker.id,created_datetime,subject,description,A.fullname as caller, B.fullname as assigned , C.name as impact, D.name as status, E.name as priority
,F.name as station_name
            FROM incidents_tracker

                INNER JOIN users as A on incidents_tracker.caller_id=A.id
                INNER JOIN users as B on incidents_tracker.assigned_id=B.id
                INNER JOIN impact as C on incidents_tracker.impact_id=C.id
                INNER JOIN status as D on incidents_tracker.status_id=D.id
                INNER JOIN priorities as E on incidents_tracker.priority_id=E.id
         INNER JOIN stations as F on incidents_tracker.station_id=F.id
            WHERE assigned_id=".$request->assigned_id."
            ORDER BY incidents_tracker.id DESC
            ";

            $incidents = DB::select(DB::raw($sql));

            return $incidents;
        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']=$e->getMessage();

            return $response;
        }
    }

    public function incidentsPerStatus(Request $request)
    {

        try {
            $sql="SELECT incidents_tracker.id,created_datetime,subject,description,A.fullname as caller, B.fullname as assigned , C.name as impact, D.name as status, E.name as priority
,F.name as station_name
            FROM incidents_tracker

                INNER JOIN users as A on incidents_tracker.caller_id=A.id
                INNER JOIN users as B on incidents_tracker.assigned_id=B.id
                INNER JOIN impact as C on incidents_tracker.impact_id=C.id
                INNER JOIN status as D on incidents_tracker.status_id=D.id
                INNER JOIN priorities as E on incidents_tracker.priority_id=E.id
         INNER JOIN stations as F on incidents_tracker.station_id=F.id
            WHERE assigned_id=".$request->assigned_id."incidents_tracker.status=1
            ORDER BY incidents_tracker.id DESC
            ";

            $incidents = DB::select(DB::raw($sql));

            return $incidents;
        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']=$e->getMessage();

            return $response;
        }

    }

    public function systemData()
    {
        try{

            $impacts = Impact::all();
            $priorities = Priority::all();
            $status = Status::all();
            $assigned = User::where('role_id',"4")->get();
            $stations = Station::all();
            $roles = Role::where('id',"2")->orWhere('id',"4")->get();

            $data = array();

            $data['impacts']=$impacts;
            $data['priorities']=$priorities;
            $data['status']=$status;
            $data['assigned']=$assigned;
            $data['stations']=$stations;
            $data['roles']=$roles;

            return $data;

        }catch (\Exception $e)
        {
            $data = array();
            $data['message']="Oops something went wrong!".$e->getMessage();
            $data['status']="fail";

            return $data;
        }
    }

    public function stations()
    {
        try{

            $stations = Station::all();

            return $stations;

        }catch (\Exception $e)
        {
            Log::info('Log message',['Station Error'=>$e->getMessage()]);
        }
    }

    public function priorities()
    {
        try{

            $priorities = Priority::all();

            return $priorities;

        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']=$e->getMessage();

            return $response;
        }
    }

    public function users()
    {
        try{

            $users = User::all();

            return $users;

        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']=$e->getMessage();

            return $response;
        }
    }

    public static function add_prefix($phone)
    {
        return strlen($phone) <= 9 ? '255' . $phone : preg_replace('/^0/', '255', $phone);
    }

    public function sendSms($request)
    {
            $to = $this->add_prefix($request['phone_number']);
            $message = "Dear ".$request['fullname']." An Incident with ID ".$request['incident_tracker']." has been assigned to you, awaiting approval";
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.evancejaye.com/sms/index.php?message='.urlencode($message).'&to='.$to,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            Log::info("SMS",['message'=>$response]);
    }

    public function storeIncident(Request $request)
    {
        //Insertion goes here
        try{
            $incident_ticket = "SL".$this->generateTxnID(10);

            $incident = new Incident();
            $incident->caller_id = $request->caller_id;
            $incident->station_id = $request->station_id;
            $incident->impact_id = $request->impact_id;
            $incident->priority_id = $request->priority_id;
            $incident->subject = $request->subject;
            $incident->description = $request->description;
            $incident->status_id = 1;
            $incident->incident_ticket = $incident_ticket;
            $incident->created_datetime = NOW();
            $incident->cancelled_datetime = NUll;
            $incident->closed_datetime = NULL;
            $incident->image = $this->processImage($request->image,$request);
            $incident->save();

            if ($incident == true) {

                $response['status']="success";
                $response['message']="Incident Added Successfully!";
                Log::error("ApiLogs",['request'=>$response]);

            } else {
                $response['status']="fail";
                $response['message']="Incident was not added!";
                Log::error("ApiLogs",['request'=>$response]);
            }

            Log::error("ApiLogs",['request'=>$request]);

           return $response;


        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']="Oops something went wrong".$e->getMessage();

            Log::error("ApiLogs",['request'=>$request]);

            return $response;
        }
    }

    public function generateTxnID($n) {

        $generator = "1357902468";
        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }

        return $result;
    }

    public function processImage($image,$request)
    {
        $imageName="";
        try {
            $image = $request->image;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = str_random(10) . '.png';

            Storage::disk('local')->put($imageName, base64_decode($image));

            return $imageName;
        }catch (\Exception $e)
        {
            Log::error("ErrorResponse",['ErrorReturned'=>$e->getMessage(), 'ErrorRequest'=>$request]);
        }

        return $imageName;
    }

    public function changePassword(Request $request)
    {

        try{

            $update = User::where('id',$request->user_id)->update([
                'password'=>bcrypt($request->password)
            ]);


            if ($update == true) {
                $response['status']="success";
                $response['message']="Password changed successfully!";
                return $response;
            } else {
                $response['status']="fail";
                $response['message']="Password was not changed!";
                return $response;
            }



        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']=$e->getMessage();

            return $response;
        }
    }

    public function smsNotification(Request $request)
    {

    }

    public function emailNotification(Request $request)
    {

    }

    public function updateCredentials(Request $request){

        if ($request->confirm_new_password === $request->new_password) {
            if (Hash::check($request->old_password,Auth::user()->password)) {
                $db = User::where('id', Auth::user()->id)->update([
                    'password' => bcrypt($request->new_password)
                ]);
                if ($db == true) {
                    $response['status']="success";
                    $response['message']="Credentials Updated Successfully!";
                } else {
                    $response['status']="fail";
                    $response['message']="Nothing was changed!";
                }
            }
            else{
                $response['status']="fail";
                $response['message']="Password Incorrect!";
            }
        }
        else{
            $response['status']="fail";
            $response['message']="New and Confirm New Password Mismatch!";
        }

        return $response;
    }


    /*
     * Incident Process summary
     */
    public function process(Request $request)
    {

        /*
         * Close Incident
         */
        if($request->status_id == 2)
        {
            $update = Incident::where('id',$request->id)->update(
                [
                    'status_id'=>$request->status_id,
                    'closing_comments'=>$request->closing_comment,
                    'closed_datetime'=>NOW(),
                    'assigned_id'=>$request->user_id
                ]
            );

            if($update==true)
            {
                $incident = Incident::where('id',$request->id)->get();
                $this->incidentTracker($incident);
            }
        }

        /*
         * Cancelled Incident
         */
        else if($request->status_id == 3)
        {
            $update = Incident::where('id',$request->id)->update(
                [
                    'status_id'=>$request->status_id,
                    'cancel_comments'=>$request->cancel_comment,
                    'cancelled_datetime'=>NOW(),
                    'caller_id'=>$request->user_id
                ]
            );

            if($update==true)
            {
                $incident = Incident::where('id',$request->id)->get();
                $this->incidentTracker($incident);
            }

        }

        /*
         * Approve Incident
         */
        else if($request->status_id == 4)
        {
            $update = Incident::where('id',$request->id)->update(
                [
                    'status_id'=>$request->status_id,
                    'approved_datetime'=>NOW(),
                    'approver_id'=>$request->user_id
                ]
            );

            if($update==true)
            {
                $incident = Incident::where('id',$request->id)->get();
                $this->incidentTracker($incident);
            }

        }

        /*
         * Pending Approval
         */
        else if($request->status_id == 5)
        {
            $update = Incident::where('id',$request->id)->update(
                [
                    'assigned_id'=>$request->assigned_id,
                    'impact_id'=>$request->impact_id,
                    'priority_id'=>$request->priority_id,
                    'subject'=>$request->subject,
                    'description'=>$request->description,
                    'status_id'=>$request->status_id,
                    'closing_comments'=>$request->closing_comment,
                    'cancel_comments'=>$request->cancel_comment,
                    'cancelled_datetime'=>NOW(),
                    'closed_datetime'=>NULL,
                ]
            );

            if($update==true)
            {
                $incident = Incident::where('id',$request->id)->get();
                $this->incidentTracker($incident);
            }

        }

        /*
         * Assigned
         */
        else if($request->status_id == 6)
        {
            $update = Incident::where('id',$request->id)->update(
                [
                    'assigned_id'=>$request->assigned_id,
                    'simba_admin_id'=>$request->user_id
                ]
            );

            if($update==true)
            {
                $incident = Incident::where('id',$request->id)->get();
                $this->incidentTracker($incident);
            }

        }

        return $update;
    }

    /*
     * Close Incident
     */
    public function closeIncident(Request $request)
    {
        try{

            $status=2;
            $update = Incident::where('id',$request->id)->update(
                [
                    'status_id'=>$status,
                    'closing_comments'=>$request->closing_comment,
                    'closed_datetime'=>NOW()
                ]
            );

            if($update==true)
            {
                $response['status']="success";
                $response['message']="Incident has been closed!";

                return $response;
            }else{
                $response['status']="failed";
                $response['message']="Something went wrong!";

                return $response;
            }

        }catch (\Throwable $e)
        {
            $response['status']="failed";
            $response['message']="An Error Occured!";

            Log::info("message",['Error'=>$e->getMessage()]);

            return $response;
        }
    }

    /*
     * Assign Incident
     */
    public function assignIncident(Request $request)
    {
        try{

            $status=6;
            $update = Incident::where('id',$request->id)->update(
                [
                    'assigned_id'=>$request->assigned_id,
                    'simba_admin_id'=>$request->user_id,
                    'status_id'=>$status,
                    'assigned_datetime'=>NOW()
                ]
            );

            if($update==true)
            {
                $response['status']="success";
                $response['message']="Incident has been assigned!";

                return $response;
            }else{
                $response['status']="failed";
                $response['message']="Something went wrong!";

                return $response;
            }

        }catch (\Throwable $e)
        {
            $response['status']="failed";
            $response['message']="An Error Occured!";

            Log::info("message",['Error'=>$e->getMessage()]);

            return $response;
        }
    }

    /*
     * Request for Approval
     */
    public function requestIncidentPermit(Request $request)
    {
        try{

            //TODO: Get job assessment form request during this process

            $status=5;
            $update = Incident::where('id',$request->id)->update(
                [
                    'status_id'=>$status,
                    'request_approval_datetime'=>NOW()
                ]
            );

            if($update==true)
            {
                $response['status']="success";
                $response['message']="Incident permission request sent!";

                return $response;
            }else{
                $response['status']="failed";
                $response['message']="Something went wrong!";

                return $response;
            }

        }catch (\Throwable $e)
        {
            $response['status']="failed";
            $response['message']="An Error Occured!";

            Log::info("message",['Error'=>$e->getMessage()]);

            return $response;
        }
    }

    /*
     * Approve Incident
     */
    public function approveIncident(Request $request)
    {
        try{

            $status=4;
            $update = Incident::where('id',$request->id)->update(
                [
                    'status_id'=>$status,
                    'approved_datetime'=>NOW(),
                    'approver_id'=>$request->user_id
                ]
            );

            if($update==true)
            {
                $response['status']="success";
                $response['message']="Incident has been approved!";

                return $response;
            }else{
                $response['status']="failed";
                $response['message']="Something went wrong!";

                return $response;
            }

        }catch (\Throwable $e)
        {
            $response['status']="failed";
            $response['message']="An Error Occured!";

            Log::info("message",['Error'=>$e->getMessage()]);

            return $response;
        }
    }

    /*
     * Cancel Incident
     */
    public function cancelIncident(Request $request)
    {
        try{

            $status=3;
            $update = Incident::where('id',$request->id)->update(
                [
                    'status_id'=>$status,
                    'cancel_comments'=>$request->cancel_comment,
                    'cancelled_datetime'=>NOW(),
                    'canceller_id'=>$request->user_id
                ]
            );

            if($update==true)
            {
                $response['status']="success";
                $response['message']="Incident has been cancelled!";

                return $response;
            }else{
                $response['status']="failed";
                $response['message']="Something went wrong!";

                return $response;
            }

        }catch (\Throwable $e)
        {
            $response['status']="failed";
            $response['message']="An Error Occured!";

            Log::info("message",['Error'=>$e->getMessage()]);

            return $response;
        }
    }

    public function incidentTracker($request)
    {

        try{

            $request = $request[0];

            $incident = new IncidentTracker();
            $incident->incident_id = $request->id;
            $incident->caller_id = $request->caller_id;
            $incident->assigned_id = $request->assigned_id;
            $incident->impact_id = $request->impact_id;
            $incident->priority_id = $request->priority_id;
            $incident->subject = $request->subject;
            $incident->description = $request->description;
            $incident->status_id = $request->status_id;
            $incident->created_datetime = $request->created_datetime;
            $incident->cancelled_datetime = $request->cancelled_datetime;
            $incident->closed_datetime = $request->closed_datetime;
            $incident->save();

            $response['status']="success";
            $response['message']="Incident Has Been Updated!";

            return $response;

        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']="Something went wrong!";

            return $response;
        }
    }

    public function registration(Request $request){


        if(!isset($request->email) && !isset($request->fullname) && !isset($request->password) &&
            !isset($request->phone_number) && !isset($request->role_id) && !isset($request->station_id))
        {
            $response['status'] = 'fail';
            $response['message'] = 'All fields should be field';

            return $response;
        }


        if($request->password!=$request->confirm_password)
        {
            $response['status'] = 'fail';
            $response['message'] = 'Password mismatch';

            return $response;
        }

        $email = User::where('email',$request->email)->get();
        $phone = User::where('phone_number',$request->phone_number)->get();

        if(count($email) == 1 || count($phone) == 1)
        {
            $response['status'] = 'fail';
            $response['message'] = 'Email or Phone number already in use';

            return $response;
        }


        try {
            $add_user = new User();
            $add_user->fullname = $request->fullname;
            $add_user->email = $request->email;
            $add_user->role_id = $request->role_id;
            $add_user->station_id = $request->station_id;
            $add_user->password = bcrypt($request->password);
            $add_user->status = 1;
            $add_user->phone_number = $request->phone_number;
            $add_user->access = "2";
            $add_user->save();

            if ($add_user == true) {
                $response['status'] = 'success';
                $response['message'] = 'Registration Successful';

                return $response;
            }

        }catch (\Exception $e)
        {
            $response['status'] = 'fail';
            $response['message'] = "Oops something went!";

            Log::info('message',['Registration Error'=>$e->getMessage()]);

            return $response;
        }


    }

    public function appReport($id)
    {

        try {
            $sql="SELECT COUNT(*) as count, status_id, D.name as status

            FROM incidents_tracker

            INNER JOIN status as D on incidents_tracker.status_id=D.id

            WHERE assigned_id=".$id."

            GROUP BY  status_id
            ";

            $incidents = DB::select(DB::raw($sql));

            return $incidents;
        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']=$e->getMessage();

            return $response;
        }

    }
}
