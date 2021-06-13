<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stations extends Model{
    ///use HasFactory;
    public $timestamp = false;
    public $table = "stations";
    /*

    create table stations(
        id int(10) not null auto_increment,
        name varchar(255),
        phone_number varchar(25),
        email varchar(25),
        longt varchar(255),
        latt varchar(255),
        company_id int(10),
        primary key(id)
    );

    */


    public function company(){
        return $this->belongsTo(Companies::class,'company_id', 'id');
    }
}
