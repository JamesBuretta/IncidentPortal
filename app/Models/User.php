<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    public function role(){
        return $this->belongsTo('App\Models\Role');
    }
    public function portalAccess(){
        return $this->belongsTo('App\Models\PortalAccess','access');
    }

    public function stations()
    {
        return $this->belongsTo(Stations::class,'station_id','id');
    }

    public function companies()
    {
        return $this->belongsTo(Companies::class,'company_id','id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'access',
        'profile',
        'tpin',
        'created_at',
        'updated_at',
        'station_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
