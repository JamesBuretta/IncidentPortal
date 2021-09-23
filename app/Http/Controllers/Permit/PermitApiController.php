<?php

namespace App\Http\Controllers\Permit;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\JobAssessment;
use Illuminate\Http\Request;

class PermitApiController extends Controller
{
    public function store(Request $request)
    {
        try{


            $helper = new helper();

            $job_id = "JOB".$this->generateTxnID(6);

            $save = new JobAssessment();
            $save->job_desc = $request->job_desc;
            $save->spare_required = $request->spare_required;
            $save->comments = $request->comments;
            $save->work_force = $request->work_force;
            $save->team_leader = $request->team_leader;
            $save->equipment_tools_list = $request->equipment_tools_list;
            $save->permit_cert = $request->permit_cert;
            $save->job_no = $request->job_no;
            $save->job_summary = $request->job_summary;
            $save->total_time_taken = $request->total_time_taken;
            $save->outstanding_work = $request->outstanding_work;
            $save->spare_parts_used = $request->comments;
            $save->extra_comments = $request->extra_comments;
            $save->user_id = $request->user_id;
            $save->incident_id = $request->incident_id;
            $save->job_id = $job_id;
            $save->save();

            if($save==true)
            {
                $response['message']="Job Assessment form submitted";
                $response['status']="success";

                return $response;
            }else{
                $response['message']="Job Assessment form failed";
                $response['status']="fail";

                return $response;
            }

        }catch (\Throwable $e)
        {
            $response['message']="An Error Occured".$e->getMessage();
            $response['status']="fail";

            return $response;
        }
    }

    public function retrieve()
    {
        $jobs = JobAssessment::all();

        return $jobs;
    }

    public function generateTxnID($n) {

        // Take a generator string which consist of
        // all numeric digits
        $generator = "1357902468";

        // Iterate for n-times and pick a single character
        // from generator and append it to $result

        // Login for generating a random character from generator
        //     ---generate a random number
        //     ---take modulus of same with length of generator (say i)
        //     ---append the character at place (i) from generator to result

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }

        // Return result
        return $result;
    }
}
