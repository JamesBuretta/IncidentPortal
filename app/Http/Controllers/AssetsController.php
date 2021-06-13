<?php

namespace App\Http\Controllers;

use App\Models\AssetAllocations;
use App\Models\Categories;
use App\Models\Assets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AssetsController extends Controller
{

    public function create()
    {
        $categories = Categories::all();
        return view('pages.assets.create', compact('categories'));
    }

    public function view()
    {
        $assets = Assets::all();
        return view('pages.assets.view', compact('assets'));
    }

    public function edit($vendor_id)
    {
        $asset = assets::Find($vendor_id);
        $categories = Categories::all();
        return view('pages.assets.edit', compact('asset', 'categories'));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'serial_number' => 'required|unique:assets',
            'md_number' => 'required',
            'grn_number' => 'required',
            'date_received' => 'required',
            'status' => 'required',
            'category_id' => 'required',
        ]);
        $is_dispatched = "n";
        $row = new Assets();
        $row->serial_number = $request->serial_number;
        $row->md_number = $request->md_number;
        $row->grn_number = $request->grn_number;
        $row->date_received = $request->date_received;
        $row->category_id = $request->category_id;
        $row->status = $request->status;
        $row->is_dispatched = $is_dispatched;
        $row->timestamps = false;
        $row->save();
        Session::flash('success', 'Record Added Successfully');
        return redirect()->back();
    }



    public function update(Request $request)
    {
        $this->validate($request, [
            'serial_number' => 'required',
            'md_number' => 'required',
            'grn_number' => 'required',
            'date_received' => 'required',
            'status' => 'required',
            'category_id' => 'required',
        ]);
        $row = Assets::where('id', $request->asset_id)->first();
        $row->serial_number = $request->serial_number;
        $row->md_number = $request->md_number;
        $row->grn_number = $request->grn_number;
        $row->category_id = $request->category_id;
        $row->date_received = $request->date_received;
        $row->status = $request->status;
        $row->timestamps = false;
        $row->save();
        Session::flash('success', 'Record Updated Successfully');
        return redirect()->back();
    }

    public function delete(Request $request){
        $row =  Assets::where('id', $request->asset_id)->first();
        $row->delete();
        $allocations =  AssetAllocations::where('asset_id', $request->asset_id)->get();
        foreach($allocations as $allocation){
            $allocation->delete();
        }
        Session::flash('success', 'Asset Removed Successfully');
        return redirect()->back();
    }
}
