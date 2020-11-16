<?php

namespace App\Http\Middleware;

use App\Models\Municipal;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DatabaseConnections
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $databases = Municipal::all();

        foreach ($databases as $database) {
            Config::set("database.connections." . $database['municipal_db_name'], [
                "driver" => "mysql",
                "port" => "3306",
                "strict" => false,
                "host" => "127.0.0.1",
                "database" => $database['municipal_db_name'],
                "username" => "root",
                "password" => "BCXTanzania1234567890"
            ]);
        }

        return $next($request);
    }
}
