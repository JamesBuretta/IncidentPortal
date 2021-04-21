<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use App\Models\MenuAccess;
use App\Models\Municipal;
use App\Models\PortalAccess;
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
        $user_accesses = PortalAccess::all();
        $municipals = Municipal::all();
        return view('pages.users.view_users',compact('users','user_accesses','municipals'));
    }

    public function update_access(Request $request,$user_id){

        $access_string = '';
        //My Profile Access
        ($request->profile == 'on') ? ($access_string .= '#profile') : '';
        //Payment History
        ($request->payment_history == 'on') ? ($access_string .= '#payment_history') : '';
        //Manage Municipals
        ($request->manage_municipals == 'on') ? ($access_string .= '#manage_municipals') : '';
        //Manage Users
        ($request->manage_users == 'on') ? ($access_string .= '#manage_users') : '';
        //Manage Profile Access
        ($request->manage_prn == 'on') ? ($access_string .= '#manage_prn') : '';
        //Manage Licence
        ($request->manage_licence == 'on') ? ($access_string .= '#manage_licence') : '';
        //View My Business
        ($request->view_business == 'on') ? ($access_string .= '#view_business') : '';
        //Manage Logs Access
        ($request->logs == 'on') ? ($access_string .= '#logs') : '';
        //View FAQ Access
        ($request->faq == 'on') ? ($access_string .= '#faq') : '';
        //Manage FAQ Access
        ($request->manage_faq == 'on') ? ($access_string .= '#manage_faq') : '';
        //System Setting's
        ($request->manage_settings == 'on') ? ($access_string .= '#manage_settings') : '';

        //Update Access Values
        $update_access = MenuAccess::where('user_id',$user_id)->first();
        $update_access->access_menu = $access_string;
        $update_access->save();

        Session::flash("success","User Access Updated Successfully");
        return redirect()->back();
    }


    public function user_access($user_id){
        //User Access Details
        $access_check = MenuAccess::where('user_id',$user_id)->count();
        $user_details = User::where(['id' => $user_id])->first();
        if($access_check == 0){
            //Register Default Access
            $new_access = new MenuAccess();
            $new_access->user_id = $user_id;
            $new_access->access_menu =  ($user_details->role_id == 1) ?  'profile#manage_settings#manage_users#manage_municipals#logs#manage_settings#manage_faq' : 'profile#payment_history#manage_prn#manage_licence#view_business#faq';
            $new_access->save();
        }

        //Check Access
        $user_access = MenuAccess::where('user_id',$user_id)->first();
        $access_array = explode("#",$user_access->access_menu);

        $user_details = User::where('id',$user_id)->first();

        return view('pages.access.user_access',compact('user_details','access_array'));
    }


    public function user_password_reset($user_id){
        $get_user_details = User::where("id",$user_id)->first();
        $generated_password = Str::random(8);

        $email = $get_user_details->email;
        $data = [
            'email'=>$get_user_details->email,
            'name'=>$get_user_details->fullname,
            'password'=>$generated_password,
        ];
        Mail::send('mails.recover_password', $data, function($message) use ($email) {
            $message->to($email, 'Support')->subject("Incident Portal - Password Recover");
            $message->from('municipalnotification@gmail.com',"Incident Portal - Password Recover");
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
       $add_user->fullname = $request->fullname;
       $add_user->email = $request->email;
       $add_user->role_id = $request->role_id;
       $add_user->municipal_id = ($request->role_id == 1) ? '-' : $request->municipal_id;
       $add_user->password = bcrypt(123456);
       $add_user->status = 1;
       $add_user->access = ($request->role_id == 1) ? 1 : 2;

        if($request->hasfile('profile'))
        {
            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move(public_path('images/profiles'), $filename);

            $add_user->profile = $filename;
        }

        $add_user->save();

        //Save Access For New User
        $last_added_user = User::where(['email' => $request->email,'fullname' => $request->fullname])->first();

        //User Access Details
        $access_check = MenuAccess::where('user_id',$last_added_user->id)->count();
        if($access_check == 0){
            //Register Default Access
            $new_access = new MenuAccess();
            $new_access->user_id = $last_added_user->id;
            $new_access->access_menu = ($request->role_id == 1) ?  'profile#manage_settings#manage_users#manage_municipals#logs#manage_settings#manage_faq' : 'profile#payment_history#manage_prn#manage_licence#view_business#faq';
            $new_access->save();
        }


        Session::flash('success','User Added Successfully');
        return redirect()->back();
    }
    public function update_user_details(Request $request,$user_id){
        if($request->hasfile('profile'))
        {
            $this->validate($request, [
                'email' => 'required',
                'fullname' => 'required',
                'tpin' => 'required',
                'phone_number' => 'required',
                'access' => 'required',
                'account_status' => 'required',
                'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            ]);
        }
        else{
            $this->validate($request, [
                'email' => 'required',
                'fullname' => 'required',
                'tpin' => 'required',
                'phone_number' => 'required',
                'account_status' => 'required',
                'access' => 'required',
            ]);
        }


        $add_user = User::where('id',$user_id)->first();
        $add_user->fullname = $request->fullname;
        $add_user->email = $request->email;
        $add_user->tpin = $request->tpin;
        $add_user->phone_number = $request->phone_number;
        $add_user->access = $request->access;
        $add_user->municipal_id = ($add_user->role_id == 1) ? '-' : $request->municipal_id;
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

        Session::flash('success','User Information Updated Successfully');
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
