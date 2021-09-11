<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationNature extends Model
{
    use HasFactory;

    protected $table="tbl_operation_nature";

    public $timestamps=false;
}
