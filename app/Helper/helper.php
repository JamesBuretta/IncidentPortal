<?php


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

function base_url(){
    if (app()->environment()=='local'){
        return Config('api.TEST-SERVER');
    }
    else if(app()->environment()=='production'){
        return Config('api.LIVE-SERVER');
    }
}

function checkTpin($municipal,$tpin){
    try {
        //Database Connection
        Config::set("database.connections.".$municipal, [
            "driver" => "mysql",
            "port" => "3306",
            "strict" => false,
            "host" => "127.0.0.1",
            "database" => $municipal,
            "username" => "root",
            "password" => ""
        ]);

        //Validate TPIN
        $query = "SELECT count(*) as total_found FROM tbl_distr_munic_portal_owner WHERE tin_number=?";
        $myQuery = DB::connection($municipal)->select($query,[$tpin]);

        if ($myQuery[0]->total_found > 0){
            $response_data = 'success';
        }else{
            $response_data = 'fail';
        }

        return $response_data;
    }
    catch (\Exception $e)
    {
        Log::info('Error message', ['context' => $e]);
        $response_data = 'fail';
        return $response_data;
    }
}
