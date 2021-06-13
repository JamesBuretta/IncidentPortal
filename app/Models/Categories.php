<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model{
    ///use HasFactory;
    public $timestamp = false;
    public $table = "categories";
    /*

    create table categories(
        id int(10) not null auto_increment,
        name varchar(512),
        vendor_id int(10),
        primary key(id)
    );

    */


    public function vendor(){
        return $this->belongsTo(Vendors::class,'vendor_id', 'id');
    }
}
