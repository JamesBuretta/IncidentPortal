<?php

namespace App\Http\Controllers\Municipal;

use App\Http\Controllers\Controller;
use App\Models\Municipal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MunicipalController extends Controller
{
    public function add_municipals(){
        $available_details = 0;

        if (Auth::user()->access == 2 && Auth::user()->tpin != '-' && Auth::user()->municipal_id != '-') {
            $available_details = 1;
        }

      return view('pages.municipals.add_municipals',compact('available_details'));
    }

    public function view_municipals(){
        $municipals = Municipal::all();
        return view('pages.municipals.view_municipals',compact('municipals'));
    }

    public function save_municipal(Request $request){
        $this->validate($request, [
            'municipal_db_name' => 'required|unique:municipals',
            'municipal_description_name' => 'required|unique:municipals',
        ]);

        $add_municipal = new Municipal();
        $add_municipal->municipal_db_name = $request->municipal_db_name;
        $add_municipal->municipal_description_name = $request->municipal_description_name;
        $add_municipal->save();

        Session::flash('success','Municipal Added Successfully');
        return redirect()->back();
    }

    public function update_municipal_details(Request $request,$municipal_id){
        $this->validate($request, [
            'municipal_db_name' => 'required',
            'municipal_description_name' => 'required',
        ]);

        $update_municipal =  Municipal::where('id',$municipal_id)->first();
        $update_municipal->municipal_db_name = $request->municipal_db_name;
        $update_municipal->municipal_description_name = $request->municipal_description_name;
        $update_municipal->save();

        Session::flash('success','Municipal Updated Successfully');
        return redirect()->back();
    }

    public function remove_municipal($municipal_id)
    {
        $municipal_details = Municipal::where("id", $municipal_id)->first();

        //Check Usage
        $check_usage = User::where('municipal_id',$municipal_details->id)->count();
        if($check_usage > 0){
            Session::flash('fail','Municipal Has been used by the user. Cant be removed');
        }else{
            $municipal_details->delete();
            Session::flash('success','Municipal Removed Successfully');
        }

        return redirect()->back();
    }

}
