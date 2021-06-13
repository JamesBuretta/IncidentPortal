<?php

namespace App\Http\Controllers;

use App\Models\Vendors;
use App\Models\Assets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VendorsController extends Controller
{
    public function add_vendors()
    {
        $available_details = 0;

        if (Auth::user()->access == 2 && Auth::user()->tpin != '-' && Auth::user()->municipal_id != '-') {
            $available_details = 1;
        }

        $this->view_vendors();
    }

    public function create(){
        return view('pages.vendors.create');
    }

    public function view(){
        $vendors = Vendors::all();
        return view('pages.vendors.view', compact('vendors'));
    }

    public function edit($vendor_id){
        $vendor = Vendors::Find($vendor_id);
        return view('pages.vendors.edit', compact('vendor'));
    }

    public function save(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required|unique:vendors',
            'email_address' => 'required|unique:vendors',
        ]);
        $row = new Vendors();
        $row->name = $request->name;
        $row->phone_number = $request->phone_number;
        $row->email_address = $request->email_address;
        $row->description = $request->description;
        $row->timestamps = false;
        $row->save();
        Session::flash('success', 'Record Added Successfully');
        return redirect()->back();
    }

    

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required',
            'email_address' => 'required',
        ]);
        $row =  Vendors::where('id',$request->vendor_id)->first();
        $row->name = $request->name;
        $row->phone_number = $request->phone_number;
        $row->email_address = $request->email_address;
        $row->description = $request->description;
        $row->timestamps = false;
        $row->save();
        Session::flash('success', 'Record Updated Successfully');
        return redirect()->back();
    }

    public function delete(Request $request){
        $row =  Vendors::where('id',$request->vendor_id)->first();
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
