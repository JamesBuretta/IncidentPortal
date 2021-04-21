<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentTracker extends Model
{
    use HasFactory;

    public $table="incidents_logs";

    public $timestamps=false;

    public function priorities()
    {
        return $this->belongsTo(Priority::class,'priority_id');
    }

    public function impacts()
    {
        return $this->belongsTo(Impact::class,'impact_id');
    }

    public function callers()
    {
        return $this->belongsTo(User::class,'caller_id');
    }

    public function assigned()
    {
        return $this->belongsTo(User::class,'assigned_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class,'status_id');
    }
}
