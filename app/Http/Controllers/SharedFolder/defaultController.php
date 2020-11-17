<?php

namespace App\Http\Controllers\SharedFolder;

use App\Http\Controllers\Controller;
use App\Models\Municipal;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class defaultController extends Controller
{
    public function dashboard(){
        $total_users = User::all()->count();
        $total_municipals = Municipal::all()->count();
        return view('pages.index',compact('total_users','total_municipals'));
    }

    public function profile(){
        $user_roles = Role::all();
        $municipals = Municipal::all();
        return view('pages.profile',compact('user_roles','municipals'));
    }
    public function update_profile(Request $request,$user_id){
        if($request->hasfile('profile'))
        {
            $this->validate($request, [
                'email' => 'required',
                'name' => 'required',
                'account_status' => 'required',
                'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            ]);
        }
        else{
            $this->validate($request, [
                'email' => 'required',
                'name' => 'required',
                'account_status' => 'required',
            ]);
        }


        $update_user = User::where('id',$user_id)->first();
        $update_user->name = $request->name;
        $update_user->email = $request->email;
        if ($request->has('municipal_id')){
            $update_user->municipal_id = $request->municipal_id;
        }
        $update_user->password = bcrypt(123456);
        $update_user->status = $request->account_status;

        if($request->hasfile('profile'))
        {
            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move(public_path('images/profiles'), $filename);

            $update_user->profile = $filename;
        }

        $update_user->save();

        Session::flash('success','User Profile Updated Successfully');
        return redirect()->back();
    }

    public function update_credentials(Request $request,$user_id){
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required',
        ]);

        if ($request->confirm_password === $request->new_password) {
            if (Hash::check($request->old_password,Auth::user()->password)) {
                $db = User::where('id', Auth::user()->id)->update([
                    'password' => bcrypt($request->new_password)
                ]);
                if ($db == true) {
                    Session::flash('success','Credentials Updated!');
                } else {
                    Session::flash('fail','No change was made!');
                }
            }
            else{
                Session::flash('fail','Password is incorrect!');
            }
        }
        else{
            Session::flash('fail','New and Confirm Password do not match!');
        }


        return redirect()->back();
    }
}
