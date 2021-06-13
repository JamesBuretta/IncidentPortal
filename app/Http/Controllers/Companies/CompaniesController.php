<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CompaniesController extends Controller
{
    public function add_companies()
    {
        $available_details = 0;

        if (Auth::user()->access == 2 && Auth::user()->tpin != '-' && Auth::user()->municipal_id != '-') {
            $available_details = 1;
        }

        $this->view_companies();
    }

    public function view_companies()
    {
        $companies = Companies::all();
        return view('pages.companies.view_companies', compact('companies'));
    }

    public function save_company(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|unique:companies',
        ]);

        $company = new Companies();
        $company->name = $request->name;
        $company->timestamps = false;
        $company->save();
        Session::flash('failed', 'Company Added Successfully');
        return redirect()->back();
    }

    public function update_company_details(Request $request, $municipal_id)
    {
        $this->validate($request, [
            'municipal_db_name' => 'required',
            'municipal_description_name' => 'required',
        ]);

        $update_company =  Municipal::where('id', $municipal_id)->first();
        $update_company->municipal_db_name = $request->municipal_db_name;
        $update_company->municipal_description_name = $request->municipal_description_name;
        $update_company->save();

        Session::flash('success', 'Municipal Updated Successfully');
        return redirect()->back();
    }

    public function remove_company($municipal_id)
    {
        $municipal_details = Municipal::where("id", $municipal_id)->first();

        //Check Usage
        $check_usage = User::where('municipal_id', $municipal_details->id)->count();
        if ($check_usage > 0) {
            Session::flash('fail', 'Municipal Has been used by the user. Cant be removed');
        } else {
            $municipal_details->delete();
            Session::flash('success', 'Municipal Removed Successfully');
        }

        return redirect()->back();
    }
}
