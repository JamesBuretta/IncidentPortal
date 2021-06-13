<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\inventory;
use App\Models\Stations;
use App\Models\Companies;
use App\Models\AssetAllocations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InventoryController extends Controller
{
    
    public function create(){
        $companies = Companies::all();
        return view('pages.inventory.create', compact('companies'));
    }

    public function view(){
        $allocations = AssetAllocations::all();
        return view('pages.inventory.view', compact('allocations'));
    }

    public function allocate_view(){
        $stations = Stations::all();
        $assets = Assets::where("is_dispatched", "n")->get();
        //return compact('stations', 'assets');
        return view('pages.inventory.allocate', compact('stations', 'assets'));
    }

    public function allocate(Request $request){
        $this->validate($request, [
            'asset_id' => 'required',
            'station_id' => 'required',
            'dispatch_date' => 'required',
            
        ]);
        $allocation_type = "Dispatched";
        $status = "Active";
        $row = new AssetAllocations();
        $row->dispatch_date = $request->dispatch_date;
        $row->allocation_type = $allocation_type;
        $row->station_id = $request->station_id;
        $row->status = $status;
        $row->asset_id = $request->asset_id;
        $row->timestamps = false;
        $row->save();

        //update the asset, set is_dispatched to true
        $asset = Assets::Find($request->asset_id);
        $asset->is_dispatched = "y";
        $asset->timestamps = false;
        $asset->save();

        Session::flash('success', 'Record Added Successfully');
        return redirect()->back();
    }

    public function disallocate(Request $request){
        $this->validate($request, [
            'asset_id' => 'required',
            'allocation_id' => 'required',
            
        ]);
        $allocation_type = "Returned";
        $status = "Inactive";
        $row = AssetAllocations::Find($request->allocation_id);
        $row->allocation_type = $allocation_type;
        $row->status = $status;
        $row->timestamps = false;
        $row->save();

        //update the asset, set is_dispatched to true
        $asset = Assets::Find($request->asset_id);
        $asset->is_dispatched = "n";
        $asset->timestamps = false;
        $asset->save();

        Session::flash('success', 'Record Updated Successfully');
        return redirect()->back();
    }

    public function disallocate_view(){
        $allocations = AssetAllocations::all();
        return view('pages.inventory.disallocate', compact('allocations'));
    }

    public function edit($station_id){
        $station = AssetAllocations::Find($station_id);
        $companies = Companies::all();
        return view('pages.inventory.edit', compact('station','companies'));
    }

    public function save(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required|unique:inventory',
            'email' => 'required|unique:inventory',
            'company_id' => 'required',
            
        ]);
        $row = new AssetAllocations();
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


    public function delete(Request $request){
        $row =  AssetAllocations::where('id',$request->allocation_id)->first();
        //Check Usage
        $row->delete();
        Session::flash('success', 'Asset allocation deleted successfully.');
        return redirect()->back();
    }
}
