<?php

namespace App\Http\Controllers\Permit;

use App\Http\Controllers\Controller;
use App\Models\JobAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PermitWebController extends Controller
{
    public function index()
    {
        $jobs = JobAssessment::all();

        return view('job_assessment.index',compact('jobs'));

    }

    public function view($id)
    {
        $job = JobAssessment::where('id',$id)->get()[0];

        return view('job_assessment.print',compact('job'));
    }

    public function requestForPermission(Request $request)
    {
        try{

            $insert = new JobAssessment();
            $insert->job_desc = $request->job_desc;
            $insert->spare_required = $request->spare_required;
            $insert->comments = $request->comments;
            $insert->work_force = $request->work_force;
            $insert->team_leader = $request->team_leader;
            $insert->equipment_tools_list = $request->equipment_tools_list;
            $insert->permit_cert = $request->permit_cert;
            $insert->job_no = $request->job_no;
            $insert->job_summary = $request->job_summary;
            $insert->total_time_taken = $request->total_time_taken;
            $insert->outstanding_work = $request->outstanding_work;
            $insert->spare_parts_used = $request->spare_parts_used;
            $insert->extra_comments = $request->extra_comments;
            $insert->user_id = $request->user_id;
            $insert->job_id = $request->job_id;
            $insert->incident_id = $request->incident_id;
            $insert->permit_status = $request->permit_status;
            $insert->save();

            if($insert==true)
            {
                Session::flash('success','Job Assessement Form Submitted');
                return redirect()->back();
            }
            else{
                Session::flash('success','Failed to create job assessment form');
                return redirect()->back();
            }


        }catch (\Throwable $e)
        {
            Log::info('message',['MeesageError'=>$e->getMessage()]);

            Session::flash('success','Oops something went wrong');
            return redirect()->back();
        }
    }

    public function approveJobAssessmentForm(Request $request)
    {
        try{

        }catch (\Throwable $e)
        {
            Log::info("message",['MessageError'=>$e->getMessage()]);

            Session::flash('success','Oops looks like an error occured');
            return redirect()->back();
        }
    }
}
