<?php
namespace App\Helper;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class helper {

    const HOST_CONNECTION_NAME = '127.0.0.1';
    const HOST_CONNECTION_CREDENTIALS = 'N4xiVrMqnf)A';

    public static function globalMunicipalDbConnection($municipal){
        //Database Connection
        Config::set("database.connections.".$municipal, [
            "driver" => "mysql",
            "port" => "3306",
            "strict" => false,
            "host" => "127.0.0.1",
            "database" => $municipal,
            "username" => "root",
            "password" => ''
        ]);

        return DB::connection($municipal);
    }

    public static function counterTpin($municipal,$tpin){
        //Validate Count TPIN
        $query = "SELECT count(*) as total_found FROM tbl_distr_munic_portal_owner WHERE tin_number=?";
        $myQuery = self::globalMunicipalDbConnection($municipal)->select($query,[$tpin]);

        return $myQuery[0]->total_found;
    }

    public static function checkTpin($municipal,$tpin){
        try {
            //Validate TPIN
            $query = "SELECT count(*) as total_found FROM tbl_distr_munic_portal_owner WHERE tin_number=?";
            $myQuery = self::globalMunicipalDbConnection($municipal)->select($query,[$tpin]);

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

}
