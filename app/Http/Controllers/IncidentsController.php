<?php /** @noinspection SqlResolve */

namespace App\Http\Controllers;

use App\Helper\helper;
use App\Models\Companies;
use App\Models\Impact;
use App\Models\Incident;
use App\Models\IncidentTracker;
use App\Models\JobAssessment;
use App\Models\Priority;
use App\Models\Stations;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class IncidentsController extends Controller
{
    public function assignIncident(Request $request)
    {
        try{

            $status="6";
            $update = IncidentTracker::where("id",$request->id)->update([
                "assigned_id"=>$request->assigned_id,
                "status_id"=>$status
            ]);

            if($update==true)
            {
                Session::flash('success','Incident Has been assigned to technician');
                return redirect()->back();
            }
            else{
                Session::flash('success','Oops something went wrong');
                return redirect()->back();
            }

        }
        catch (\Throwable $e)
        {
            Session::flash('success','Oops looks like an error occured');
            return redirect()->back();
        }
    }

    public function closeIncident(Request $request)
    {
        try{

            $status="2";
            $update = IncidentTracker::where("id",$request->id)->update([
                "closing_comments"=>$request->closing_comments,
                "status_id"=>$status
            ]);

            if($update==true)
            {
                Session::flash('success','Incident has been closed successfully');
                return redirect()->back();
            }
            else{
                Session::flash('success','Oops something went wrong');
                return redirect()->back();
            }

        }catch (\Throwable $e)
        {
            Log::info("message",["MessageError"=>$e->getMessage()]);

            Session::flash('success','Oops looks like an error occured');
            return redirect()->back();
        }
    }

    public function cancelIncident(Request $request)
    {
        try{
            $status="3";
            $update = IncidentTracker::where("id",$request->id)->update([
                "cancel_comments"=>$request->cancel_comments,
                "status_id"=>$status
            ]);

            if($update==true)
            {
                Session::flash('success','Incident has been cancelled successfully');
                return redirect()->back();
            }
            else{
                Session::flash('success','Oops something went wrong');
                return redirect()->back();
            }

        }catch (\Throwable $e)
        {
            Log::info("message",["MessageError"=>$e->getMessage()]);

            Session::flash('success','Oops looks like an error occured');
            return redirect()->back();
        }
    }

    public function index()
    {
        $impacts = Impact::all();
        $priorities = Priority::all();
        $status = Status::all();
        $callers = User::all();

        $user = User::where("id",Auth::id())->get()[0];

        $company_id =  Auth::user()->company_id;
        $role_id="4";

        $technicians = User::where("company_id",$company_id)->where('role_id',$role_id)->get();

        //Administrator sees everything
        if(Auth::user()->role_id=="1") {
            $technicians = User::where('role_id',$role_id)->get();
            $incidents = DB::table('incidents_tracker as it')->select(
                'it.id',
                'it.incident_ticket',
                'it.created_datetime',
                'it.subject',
                'it.image',
                'it.description',
                'A.fullname as caller',
                'B.fullname as assigned',
                'C.name as impact',
                'D.name as status',
                'E.name as priority')
                ->join('users as A', 'it.caller_id', '=', 'A.id')
                ->leftJoin('users as B', 'it.assigned_id', '=', 'B.id')
                ->join('impact as C', 'it.impact_id', '=', 'C.id')
                ->join('status as D', 'it.status_id', '=', 'D.id')
                ->join('priorities as E', 'it.priority_id', '=', 'E.id')
                ->orderBy('it.created_datetime', 'DESC')
                ->get();
        }
        //Client and Dealer see only their company stations
        else if(Auth::user()->role_id=="2" || Auth::user()->role_id=="3")
        {
            $stations = Stations::select('id')->where('company_id',$company_id)->get();

            $array = array();
            $value = 0;

            foreach($stations as $station)
            {

                $array[$value]=$station->id;

                $value++;
            }


            $incidents = DB::table('incidents_tracker as it')->select(
                'it.id',
                'it.incident_ticket',
                'it.created_datetime',
                'it.subject',
                'it.image',
                'it.description',
                'A.fullname as caller',
                'B.fullname as assigned',
                'C.name as impact',
                'D.name as status',
                'E.name as priority')
                ->join('users as A', 'it.caller_id', '=', 'A.id')
                ->leftJoin('users as B', 'it.assigned_id', '=', 'B.id')
                ->join('impact as C', 'it.impact_id', '=', 'C.id')
                ->join('status as D', 'it.status_id', '=', 'D.id')
                ->join('priorities as E', 'it.priority_id', '=', 'E.id')
                ->whereIn('it.station_id',$array)
                ->orderBy('it.created_datetime', 'DESC')
                ->get();
        }
        //Technician only sees incidents assigned to him/her
        else if(Auth::user()->role_id=="4")
        {
            $incidents = DB::table('incidents_tracker as it')->select(
                'it.id',
                'it.incident_ticket',
                'it.created_datetime',
                'it.subject',
                'it.image',
                'it.description',
                'A.fullname as caller',
                'B.fullname as assigned',
                'C.name as impact',
                'D.name as status',
                'E.name as priority')
                ->join('users as A', 'it.caller_id', '=', 'A.id')
                ->leftJoin('users as B', 'it.assigned_id', '=', 'B.id')
                ->join('impact as C', 'it.impact_id', '=', 'C.id')
                ->join('status as D', 'it.status_id', '=', 'D.id')
                ->join('priorities as E', 'it.priority_id', '=', 'E.id')
                ->where('it.assigned_id',$user->id)
                ->orderBy('it.created_datetime', 'DESC')
                ->get();
        }

        return view('incidents.create',compact('impacts','priorities','status','callers','incidents','technicians'));
    }



    public function store(Request $request)
    {
        //Validations goes here
        $this->validate($request,[
            'caller_id'=>'required',
            'assigned_id'=>'required',
            'impact_id'=>'required',
            'priority_id'=>'required',
            'subject'=>'required',
            'description'=>'required',
        ]);

        //Insertion goes here
        try{

            $incident = new Incident();
            $incident->caller_id = $request->caller_id;
//            $incident->assigned_id = $request->assigned_id;
            $incident->impact_id = $request->impact_id;
            $incident->priority_id = $request->priority_id;
            $incident->subject = $request->subject;
            $incident->description = $request->description;
            $incident->status_id = 1;
            $incident->incident_ticket = "SL".$this->generateTxnID(10);
            $incident->created_datetime = NOW();
            $incident->cancelled_datetime = NUll;
            $incident->closed_datetime = NULL;
            $incident->save();

            if ($incident == true) {
                Session::flash('success','Incidence Added Successfully');
                return redirect()->back();
            } else {
                Session::flash('danger','Nothing has changed!');
                return redirect()->back();
            }


        }catch (\Exception $e)
        {
            Session::flash('danger','An error occured!');
            return redirect()->back();
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

    public function edit($id)
    {

        try {
            $incident = Incident::where('id',$id)->get()[0];
            $impacts = Impact::all();
            $priorities = Priority::all();
            $status = Status::all();
            $callers = User::all();

            return view('incidents.edit',compact('incident','impacts','priorities','status','callers'));

        }catch (\Exception $e)
        {
            Session::flash('danger','Oops Something went wrong '.$e->getMessage());

            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'assigned_id'=>'required',
            'impact_id'=>'required',
            'priority_id'=>'required',
            'subject'=>'required',
            'description'=>'required',
            'status_id'=>'required'
        ]);

        try{

            $update = $this->process($request);

            if ($update == true) {
                $userDetails = User::where('id',$request->assigned_id)->get()[0];
                $this->sendSms($userDetails);
                Session::flash('success','Incidence Updated');
                return redirect()->back();
            } else {
                Session::flash('danger','Nothing has changed!');
                return redirect()->back();
            }

        }catch (\Exception $e)
        {
            Session::flash('danger','An error occured!');
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {

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
                    'cancel_comments'=>NULL,
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
                    'closing_comments'=>NULL,
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

        else if($request->status_id == 4)
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
                    'cancelled_datetime'=>NULL,
                    'closed_datetime'=>NULL,
                ]
            );

            if($update==true)
            {
                $this->multipleSms();
                $incident = Incident::where('id',$request->id)->get();
                $this->incidentTracker($incident);
            }

        }


        return $update;
    }

    public function callCenterSms($request)
    {
        $to = $this->add_prefix($request['phone_number']);
        $message = "Dear Call Center new Incident has been logged awaiting technician allocation!";
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


    public function multipleSms()
    {
        $users = User::where('role_id','1')->get();

        foreach($users as $user)
        {
            $this->callCenterSms($user);
        }

        $response = array("message"=>"All Sms Were Sent");
    }


    public static function add_prefix($phone)
    {
        return strlen($phone) <= 9 ? '255' . $phone : preg_replace('/^0/', '255', $phone);
    }

    public function sendSms($request)
    {
        $to = $this->add_prefix($request->phone_number);
        $message = "Dear ".$request->fullname.", Incident has been assigned to you, visit application for more details!";
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
            $incident->status_id = 1;
            $incident->created_datetime = $request->created_datetime;
            $incident->cancelled_datetime = $request->cancelled_datetime;
            $incident->closed_datetime = $request->closed_datetime;
            $incident->save();

        }catch (\Exception $e)
        {

        }
    }

    public function cancel(Request $request)
    {

        $this->validate($request,[
            'cancel_comment'=>'required'
        ]);

        try{
            $status = 3;
            $cancel = Incident::where('id',$request->cancel_id)->update(
                [
                    'status_id'=>$status,
                    'cancel_comments'=>$request->cancel_comment,
                    'cancelled_datetime'=>NOW(),
                    'closed_datetime'=>NULL
                ]
            );

            if ($cancel == true) {
                $notification="Incident has been cancelled!";
                $color="success";
            } else {
                $notification="Oops something went wrong!";
                $color="danger";
            }

            return redirect('view_incidents')->with('notification',$notification)->with('color',$color);

        }catch (\Exception $e)
        {
            $notification="Oops something went wrong!";
            $color="danger";
            return redirect('view_incidents')->with('notification',"Oops looks like something went wrong!")->with('color',$color);
        }

    }

    public function close(Request $request)
    {
        $this->validate($request,[
            'closing_comment'=>'required'
        ]);


        try{
            $status = 2;
            $close = Incident::where('id',$request->close_id)->update(
                [
                    'status_id'=>$status,
                    'closing_comments'=>$request->closing_comment,
                    'closed_datetime'=>NOW(),
                    'cancelled_datetime'=>NULL
                ]
            );



            if ($close == true) {
                $notification="Incident has been closed!";
                $color="success";
            } else {
                $notification="Oops something went wrong!";
                $color="danger";
            }

            return redirect('view_incidents')->with('notification',$notification)->with('color',$color);

        }catch (\Exception $e)
        {
            return redirect('view_incidents')->with('notification',"Oops looks like something went wrong!")->with('color',$color);
        }
    }

    public function report(){
        $company_id =  Auth::user()->company_id;
        $role_id="4";
        $dealer="2";
        $technician="1";
        $client="3";

        $technicians = User::where("company_id",$company_id)->where('role_id',$role_id)->get();

        $impacts = Impact::all();
        $priorities = Priority::all();
        $status = Status::all();
        $callers = User::where("company_id",$company_id)
            ->where('role_id',$dealer)
            ->orWhere('role_id',$technician)
            ->orWhere('role_id',$client)
            ->get();

        $incidents = DB::table('incidents_tracker as it')->select(
            'it.id',
            'it.incident_ticket',
            'it.created_datetime',
            'it.subject',
            'it.image',
            'it.description',
            'A.fullname as caller',
            'B.fullname as assigned',
            'C.name as impact',
            'D.name as status',
            'E.name as priority')
            ->join('users as A', 'it.caller_id', '=', 'A.id')
            ->leftJoin('users as B', 'it.assigned_id', '=', 'B.id')
            ->join('impact as C', 'it.impact_id', '=', 'C.id')
            ->join('status as D', 'it.status_id', '=', 'D.id')
            ->join('priorities as E', 'it.priority_id', '=', 'E.id')
            ->orderBy('it.created_datetime', 'DESC')
            ->get();

        return view('incidents.report',compact('impacts','technicians','priorities','status','callers','incidents'));
    }


    public function reportfiltered2(Request $r){
        $impacts = Impact::all();
        $priorities = Priority::all();
        $status = Status::all();
        $callers = User::all();
        $callers = User::all();


        //date filtering
        if(isset($r->from_date)){
            $from_date = $r->from_date;
        }
        if(isset($r->to_date)){
            $to_date = $r->to_date;
            $to_date = $r->to_date;
        }
        if(isset($from_date) && isset($to_date)){
            $from = date('Y-m-d h:i:s A', strtotime($from_date));
            $to = date('Y-m-d h:i:s', strtotime($to_date));
            $date_filter = "incidents_tracker.created_datetime between '$from' and '$to' ";
        }else{
            $date_filter = "";
        }


        $sql="SELECT incidents_tracker.id,created_datetime,subject,description,A.fullname as caller, B.fullname as assigned , C.name as impact, D.name as status, E.name as priority
            FROM incidents_tracker
                INNER JOIN users as A on incidents_tracker.caller_id=A.id
                INNER JOIN users as B on incidents_tracker.assigned_id=B.id
                INNER JOIN impact as C on incidents_tracker.impact_id=C.id
                INNER JOIN status as D on incidents_tracker.status_id=D.id
                INNER JOIN priorities as E on incidents_tracker.priority_id=E.id
            ORDER BY incidents_tracker.created_datetime DESC
            ";

        $incidents = DB::select(DB::raw($sql));

        return view('incidents.report',compact('impacts','priorities','status','callers',
        'incidents',
        'from_date',
        'to_date'
        ));
    }

    public function reportfiltered(Request $request)
    {
        try{
            $company_id =  Auth::user()->company_id;
            $role_id="4";
            $dealer="2";
            $client="3";
            $technician="3";

            $technicians = User::where("company_id",$company_id)->where('role_id',$role_id)->get();

            $impacts = Impact::all();
            $priorities = Priority::all();
            $status = Status::all();
            $callers = User::where("company_id",$company_id)
                ->where('role_id',$dealer)
                ->orWhere('role_id',$client)
                ->orWhere('role_id',$technician)
                ->get();

            //Stations
            if(isset($request->station_id))
            {
                $station=array('it.station_id'=>$request->station_id);
            }
            else{
                $station=array();
            }

            //Status
            if(isset($request->status_id))
            {
                $status=array('it.status_id'=>$request->status_id);
            }
            else{
                $status=array();
            }

            //Assigned
            if(isset($request->assigned_id))
            {
                $assigned=array('it.assigned_id'=>$request->assigned_id);
            }
            else{
                $assigned=array();
            }

            //Caller
            if(isset($request->caller_id))
            {
                $caller=array('it.caller_id'=>$request->caller_id);
            }
            else{
                $caller=array();
            }

            //Impact
            if(isset($request->impact_id))
            {
                $impact=array('it.impact_id'=>$request->impact_id);
            }
            else{
                $impact=array();
            }

            //Priority
            if(isset($request->priority_id))
            {
                $priority=array('it.priority_id'=>$request->priority_id);
            }
            else{
                $priority=array();
            }


            //From Date and To Date
            if(isset($request->from_date) && isset($request->to_date))
            {
                $datetime=array(Helper::extract_datetime_portal($request->from_date),Helper::extract_datetime_portal($request->to_date));
                $created_datetime="it.created_datetime";
            }
            else{
                $from = date(Helper::extract_datetime('2020-01-01'));
                $to = NOW();
                $datetime=array($from,$to);
                $created_datetime="it.created_datetime";
            }


            $incidents = DB::table('incidents_tracker as it')->select(
                'it.id',
                'it.incident_ticket',
                'it.created_datetime',
                'it.subject',
                'it.image',
                'it.description',
                'A.fullname as caller',
                'B.fullname as assigned',
                'C.name as impact',
                'D.name as status',
                'E.name as priority',
                'F.name as station_name')
                ->join('users as A', 'it.caller_id', '=', 'A.id')
                ->leftJoin('users as B', 'it.assigned_id', '=', 'B.id')
                ->join('impact as C', 'it.impact_id', '=', 'C.id')
                ->join('status as D', 'it.status_id', '=', 'D.id')
                ->join('priorities as E', 'it.priority_id', '=', 'E.id')
                ->leftJoin('stations as F', 'it.station_id', '=', 'F.id')
                ->where($station)
                ->where($status)
                ->where($impact)
                ->where($caller)
                ->where($assigned)
                ->whereBetween($created_datetime,$datetime)
                ->get();

            return view('incidents.report',compact('impacts','technicians','priorities','status','callers','incidents'));

        }
        catch (\Throwable $e)
        {
            $response = array(
                "status"=>"fail",
                "message"=>"Failed to pull report",
                "error"=>$e->getMessage()
            );

            return $response;
        }
    }



}
