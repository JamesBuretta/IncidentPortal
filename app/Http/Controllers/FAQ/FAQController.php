<?php

namespace App\Http\Controllers\FAQ;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FAQController extends Controller
{
    public function add_new_faq(){
        return view('pages.faq.add_faq');
    }

    public function view_added_faq(){
        return view('pages.faq.view_added_faq');
    }

    public function view_user_faq(){
        return view('pages.faq.view_user_faq');
    }

    public function save_new_faq(Request $request){
        $this->validate($request, [
            'title' => 'required|unique:f_a_q_s',
            'answer' => 'required',
        ]);

        //Confirm Title Duplicate
        $all_faqs = FAQ::all();
        $confirm_counter = 0;
        foreach ($all_faqs as $all_faq){
           if (strtolower($all_faq->title) == strtolower($request->title)){
               $confirm_counter += 1;
           }
        }

        if ($confirm_counter > 0){
            Session::flash('error','Title already been taken. Use another title!');
            return redirect()->back();
        }

        $save_faq = new FAQ();
        $save_faq->title = $request->title;
        $save_faq->answer = $request->answer;
        $save_faq->save();

        Session::flash('success','New FAQ Added Successfully');
        return redirect()->back();
    }

    public function load_faq_data($filterVal){
        $output_data = ($filterVal == 'default')
            ? FAQ::all()
            :  DB::table('f_a_q_s as faq')
                ->where([
                    ['faq.title', 'like', '%' . $filterVal . '%'],
                ])
                ->orWhere([
                    ['faq.answer', 'like', '%' . $filterVal . '%'],
                ])->get();

        return response()->json(['faq' => $output_data]);
    }
}
