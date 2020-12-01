<?php

namespace App\Http\Controllers;

use App\Models\PortalAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AccessControlController extends Controller
{
    public function menu_access($user){
        //User ID
        $user_id = $user->id;
        Gate::define('menu-access-control', function ($user_id) {});
    }
}
