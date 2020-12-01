<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogsController extends Controller
{
    public function logs_list(){
        try {

        }catch (\Exception $e)
        {
            Log::info('Error message', ['context' => $e]);
        }


        return view('pages.logs.log_file');
    }
}
