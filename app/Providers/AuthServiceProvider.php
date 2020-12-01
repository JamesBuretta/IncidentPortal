<?php

namespace App\Providers;

use App\Models\MenuAccess;
use App\Models\PortalAccess;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('menu-access-control', function ($user,$menu_name) {
            //User Access
            if ($user->portalAccess['access_name'] == 'superadmin'){
                //Allow All Access
                return  true;
            }
            else{
                //Check User Access
                $access_check = MenuAccess::where('user_id',$user->id)->count();
                if($access_check == 0){
                    //Register Default Access
                    $new_access = new MenuAccess();
                    $new_access->user_id = $user->id;
                    $new_access->access_menu = 'profile#payment_history#manage_prn#manage_licence';
                    $new_access->save();
                }

                //Check Access
                $user_access = MenuAccess::where('user_id',$user->id)->first();
                $access_array = explode("#",$user_access->access_menu);

                //Verify Access
                if (in_array($menu_name,$access_array)){
                    return true;
                }else{
                    return false;
                }
            }
        });
    }
}
