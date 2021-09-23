<?php

namespace App\Http\Controllers\Permit;

use App\Http\Controllers\Controller;
use App\Models\JobAssessment;
use Illuminate\Http\Request;

class PermitWebController extends Controller
{
    public function index()
    {
        $jobs = JobAssessment::all();

        return view('job_assessment.job_assess',compact('jobs'));

    }

    public function view($id)
    {
        $job = JobAssessment::where('id',$id)->get()[0];

        return view('job_assessment.print',compact('job'));
    }
}
