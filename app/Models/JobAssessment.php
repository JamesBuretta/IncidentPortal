<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAssessment extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $table="tbl_assessment";

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function incidents()
    {
        return $this->belongsTo(Incident::class,'incident_id','id');
    }
}
