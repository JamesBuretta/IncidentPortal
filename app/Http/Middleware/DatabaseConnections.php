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
        return $next($request);
    }
}
