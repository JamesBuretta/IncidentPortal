<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\CustomerSupportMessage;
use App\Models\SupportCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class CustomerSupportController extends Controller
{
    public function contact_support(){
        $support_category = SupportCategory::all();

        return view('pages.support.customer_support',compact('support_category'));
    }

    public function live_support(){
        return view('pages.support.live_support');
    }

    public function send_message_support(Request $request){
        $this->validate($request, [
            'support_category' => 'required',
            'message' => 'required',
        ]);

        $save_new_message = new CustomerSupportMessage();
        $save_new_message->requested_by = Auth::user()->id;
        $save_new_message->support_category = $request->support_category;
        $save_new_message->message = $request->message;
        $save_new_message->save();

        Session::flash('success','Message Send Successfully to Support');
        return redirect()->back();
    }
}
