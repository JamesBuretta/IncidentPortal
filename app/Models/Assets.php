<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model{
    ///use HasFactory;
    public $timestamp = false;
    public $table = "assets";
    /*

    create table assets(
        id int(10) not null auto_increment,
        serial_number varchar(100),
        md_number int(100),
        grn_number int(100),
        date_received varchar(25),
        status varchar(25),
        is_dispatched varchar(2),
        category_id int(10),
        primary key(id)
    );

    */


    public function category(){
        return $this->belongsTo(Categories::class,'category_id', 'id');
    }
}
