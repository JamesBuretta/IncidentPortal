<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function dashboard(){
        return view('pages.index');
    }
    public function profile(){
        return view('pages.profile');
    }
    public function add_users(){
        $roles = Role::all();
        return view('pages.users.add_users',compact('roles'));
    }
    public function view_users(){
        return view('pages.users.view_users');
    }
    public function save_user(Request $request){
        if($request->hasfile('profile'))
        {
            $this->validate($request, [
                'email' => 'required',
                'fullname' => 'required',
                'role_id' => 'required',
                'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            ]);
        }
        else{
            $this->validate($request, [
                'email' => 'required',
                'fullname' => 'required',
                'role_id' => 'required',
            ]);
        }


       $add_user = new User();
       $add_user->name = $request->fullname;
       $add_user->email = $request->email;
       $add_user->role_id = $request->role_id;
       $add_user->password = bcrypt(123456);
       $add_user->status = 1;

        if($request->hasfile('profile'))
        {
            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move(public_path('images/profiles'), $filename);

            $add_user->profile = $filename;
        }

        $add_user->save();

        Session::flash('success','User Added Successfully');
        return redirect()->back();
    }
}
