<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Stations;
use App\Models\Companies;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StationsController extends Controller
{
    public function add_stations()
    {
        $available_details = 0;

        if (Auth::user()->access == 2 && Auth::user()->tpin != '-' && Auth::user()->municipal_id != '-') {
            $available_details = 1;
        }

        $this->view_stations();
    }

    public function create(){
        $companies = Companies::all();
        return view('pages.stations.create', compact('companies'));
    }

    public function view(){
        $stations = stations::all();
        return view('pages.stations.view', compact('stations'));
    }

    public function edit($station_id){
        $station = Stations::Find($station_id);
        $companies = Companies::all();
        return view('pages.stations.edit', compact('station','companies'));
    }

    public function save(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required|unique:stations',
            'email' => 'required|unique:stations',
            'company_id' => 'required',
            
        ]);
        $row = new Stations();
        $row->name = $request->name;
        $row->phone_number = $request->phone_number;
        $row->email = $request->email;
        $row->longt = $request->longt;
        $row->latt = $request->latt;
        $row->company_id = $request->company_id;
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
            'company_id' => 'required',
            
        ]);
        $row =  Stations::where('id',$request->station_id)->first();
        $row->name = $request->name;
        $row->phone_number = $request->phone_number;
        $row->email = $request->email;
        $row->longt = $request->longt;
        $row->latt = $request->latt;
        $row->company_id = $request->company_id;
        $row->timestamps = false;
        $row->save();
        Session::flash('success', 'Record Updated Successfully');
        return redirect()->back();
    }

    public function delete(Request $request){
        $row =  stations::where('id',$request->company_id)->first();
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
