<?php

namespace App\Http\Controllers;

use App\Models\Assets;
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

    public function create(){
        return view('pages.companies.create');
    }

    public function view(){
        $companies = Companies::all();
        return view('pages.companies.view', compact('companies'));
    }

    public function edit($vendor_id){
        $company = Companies::Find($vendor_id);
        return view('pages.companies.edit', compact('company'));
    }

    public function save(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required|unique:companies',
            'email' => 'required|unique:companies',
            'address' => 'required',
        ]);
        $row = new Companies();
        $row->name = $request->name;
        $row->phone_number = $request->phone_number;
        $row->email = $request->email;
        $row->address = $request->address;
        $row->timestamps = false;
        $row->save();
        Session::flash('success', 'Record Added Successfully');
        return redirect()->back();
    }

    

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $row =  companies::where('id',$request->company_id)->first();
        $row->name = $request->name;
        $row->phone_number = $request->phone_number;
        $row->email = $request->email;
        $row->address = $request->address;
        $row->timestamps = false;
        $row->save();
        Session::flash('success', 'Record Updated Successfully');
        return redirect()->back();
    }

    public function delete(Request $request){
        $row =  companies::where('id',$request->company_id)->first();
        //Check Usage
        $check_usage = Assets::where('vendor_id', $row->id)->count();
        if ($check_usage > 0) {
            Session::flash('fail', 'Vendor has active products. Cant be removed');
        } else {
            $row->delete();
            Session::flash('success', 'Vendor Removed Successfully');
        }

        return redirect()->back();
    }
}
