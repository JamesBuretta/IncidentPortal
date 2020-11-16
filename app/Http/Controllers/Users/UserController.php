<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use App\Models\Municipal;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Mail;

class UserController extends Controller
{
    public function add_users(){
        $roles = Role::all();
        $municipals = Municipal::all();
        return view('pages.users.add_users',compact('roles','municipals'));
    }
    public function view_users(){
        $users = User::all();
        $user_roles = Role::all();
        $municipals = Municipal::all();
        return view('pages.users.view_users',compact('users','user_roles','municipals'));
    }
    public function user_password_reset($user_id){
        $get_user_details = User::where("id",$user_id)->first();
        $generated_password = Str::random(8);

        $email = $get_user_details->email;
        $data = [
            'email'=>$get_user_details->email,
            'name'=>$get_user_details->name,
            'password'=>$generated_password,
        ];
        Mail::send('mails.recover_password', $data, function($message) use ($email) {
            $message->to($email, 'Support')->subject("Citizen Portal - Password Recover");
            $message->from('mailsendernotification@gmail.com',"Citizen Portal - Password Recover");
        });

        if (Mail::failures()) {
            Session::flash("fail","Something went wrong when sending the email. Try Again");
            return redirect()->back();
        }

        $get_user_details->password = bcrypt($generated_password);
        $get_user_details->save();

        Session::flash("success","Password Successfully Resetted");
        return redirect()->back();
    }
    public function save_user(Request $request){
        if($request->hasfile('profile'))
        {
            $this->validate($request, [
                'email' => 'required',
                'fullname' => 'required',
                'role_id' => 'required',
                'municipal_id' => 'required',
                'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            ]);
        }
        else{
            $this->validate($request, [
                'email' => 'required',
                'fullname' => 'required',
                'municipal_id' => 'required',
                'role_id' => 'required',
            ]);
        }


       $add_user = new User();
       $add_user->name = $request->fullname;
       $add_user->email = $request->email;
       $add_user->role_id = $request->role_id;
       $add_user->municipal_id = ($request->role_id == 1) ? '-' : $request->municipal_id;
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
    public function update_user_details(Request $request,$user_id){
        if($request->hasfile('profile'))
        {
            $this->validate($request, [
                'email' => 'required',
                'name' => 'required',
                'role_id' => 'required',
                'account_status' => 'required',
                'municipal_id' => 'required',
                'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            ]);
        }
        else{
            $this->validate($request, [
                'email' => 'required',
                'name' => 'required',
                'account_status' => 'required',
                'municipal_id' => 'required',
                'role_id' => 'required',
            ]);
        }


        $add_user = User::where('id',$user_id)->first();
        $add_user->name = $request->name;
        $add_user->email = $request->email;
        $add_user->role_id = $request->role_id;
        $add_user->municipal_id = ($request->role_id == 1) ? '-' : $request->municipal_id;
        $add_user->password = bcrypt(123456);
        $add_user->status = $request->account_status;

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

    public function remove_user($user_id){
        $user_details = User::where("id",$user_id)->first();

        if ($user_details->profile != "-"){
            $image_path = public_path()."/images/profiles/".$user_details->profile;

            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $user_details->delete();

        Session::flash("success","User Information Successfully Removed");
        return redirect()->back();
    }
}
