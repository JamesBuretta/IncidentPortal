<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Assets;
use App\Models\User;
use App\Models\Vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{


    public function create(){
        $vendors = Vendors::all();
        return view('pages.categories.create', compact('vendors'));
    }

    public function view(){
        $categories = Categories::all();
        return view('pages.categories.view', compact('categories'));
    }

    public function edit($vendor_id){
        $category = Categories::Find($vendor_id);
        $vendors = Vendors::all();
        return view('pages.categories.edit', compact('category', 'vendors'));
    }

    public function save(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'vendor_id' => 'required',
        ]);
        $row = new Categories();
        $row->name = $request->name;
        $row->vendor_id = $request->vendor_id;
        $row->timestamps = false;
        $row->save();
        Session::flash('success', 'Record Added Successfully');
        return redirect()->back();
    }

    

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'vendor_id' => 'required',
        ]);
        $row =  Categories::where('id',$request->category_id)->first();
        $row->name = $request->name;
        $row->vendor_id = $request->vendor_id;
        $row->timestamps = false;
        $row->save();
        Session::flash('success', 'Record Updated Successfully');
        return redirect()->back();
    }

    public function delete(Request $request){
        $row =  Categories::where('id',$request->category_id)->first();
        $row->delete();
        Session::flash('success', 'Category Removed Successfully');
        return redirect()->back();
    }
}
