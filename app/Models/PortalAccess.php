<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalAccess extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo('App\Models\User','access');
    }
}
