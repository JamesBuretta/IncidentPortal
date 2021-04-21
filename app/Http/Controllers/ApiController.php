<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Models\Impact;
use App\Models\Incident;
use App\Models\IncidentTracker;
use App\Models\MenuAccess;
use App\Models\Priority;
use App\Models\Station;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

                $response['userDetails'] = User::where('phone_number',request('phone_number'))->get();
                $response['status'] = 'success';
                $response['message'] = 'Authorized user';
                $response['token'] = $user->createToken('MyApp')->accessToken;

                return $response;

            } else {

                return response()->json(['status' => 'fail', 'message' => 'Incorrect Phone number or Password'], 200);
            }
        }catch (\Exception $e)
        {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()], 401);
        }
    }

    public function incidents()
    {

        try {
            $sql="SELECT created_datetime,subject,description,A.fullname as caller, B.fullname as assigned , C.name as impact, D.name as status, E.name as priority

            FROM incidents_tracker
                INNER JOIN users as A on incidents_tracker.caller_id=A.id
                INNER JOIN users as B on incidents_tracker.assigned_id=B.id
                INNER JOIN impact as C on incidents_tracker.impact_id=C.id
                INNER JOIN status as D on incidents_tracker.status_id=D.id
                INNER JOIN priorities as E on incidents_tracker.priority_id=D.id
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
            $assigned = User::all();

            $data = array();

            $data['impacts']=$impacts;
            $data['priorities']=$priorities;
            $data['status']=$status;
            $data['assigned']=$assigned;

            return $data;

        }catch (\Exception $e)
        {
            $data = array();
            $data['message']="Oops something went wrong!";
            $data['status']="fail";
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

    public function storeIncident(Request $request)
    {
        //Insertion goes here
        try{

            $incident = new Incident();
            $incident->caller_id = $request->caller_id;
            $incident->assigned_id = $request->assigned_id;
            $incident->impact_id = $request->impact_id;
            $incident->priority_id = $request->priority_id;
            $incident->subject = $request->subject;
            $incident->description = $request->description;
            $incident->status_id = 1;
            $incident->created_datetime = NOW();
            $incident->cancelled_datetime = NUll;
            $incident->closed_datetime = NULL;
            $incident->save();

            if ($incident == true) {
                $response['status']="success";
                $response['message']="Incident Added Successfully!";
            } else {
                $response['status']="fail";
                $response['message']="Incident was not added!";
            }

           return $response;


        }catch (\Exception $e)
        {
            $response['status']="fail";
            $response['message']="Oops something went wrong";

            return $response;
        }
    }

    public function changePassword(Request $request)
    {
        //Insertion goes here
        try{

            $old_password = User::where('id',$request->id)->get();

            if($request->old_password != $old_password->password)
            {
                $response['status']="fail";
                $response['message']="Incorrect Old Password!";
                return $response;
            }

            $update = User::where('id',$request->id)->update([
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
            $response['message']="Oops something went wrong";

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

    public function process(Request $request)
    {
        if($request->status_id == 1)
        {
            $update = Incident::where('id',$request->id)->update(
                [
                    'assigned_id'=>$request->assigned_id,
                    'impact_id'=>$request->impact_id,
                    'priority_id'=>$request->priority_id,
                    'subject'=>$request->subject,
                    'description'=>$request->description,
                    'status_id'=>$request->status_id,
                    'closing_comments'=>NULL,
                    'cancel_comments'=>NULL,
                    'closed_datetime'=>NULL,
                    'cancelled_datetime'=>NULL
                ]
            );

            if($update==true)
            {
                $incident = Incident::where('id',$request->id)->get();
                $this->incidentTracker($incident);
            }

        }

        else if($request->status_id == 2)
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
                    'closed_datetime'=>NOW(),
                    'cancelled_datetime'=>NULL
                ]
            );

            if($update==true)
            {
                $incident = Incident::where('id',$request->id)->get();
                $this->incidentTracker($incident);
            }
        }

        else if($request->status_id == 3)
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


        return $update;
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

        $validate = $this->validate($request, [
                'email' => 'required',
                'fullname' => 'required',
                'password'=>'required',
                'phone_number'=>'required'
            ]);

        if($validate==false)
        {
            $response['status'] = 'fail';
            $response['message'] = 'Registration Failed';

            return $response;
        }


        try {
            $add_user = new User();
            $add_user->fullname = $request->fullname;
            $add_user->email = $request->email;
            $add_user->role_id = "2";
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
            $response['message'] = 'Oops something went wrong!';

            return $response;
        }


    }
}
