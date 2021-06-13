<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model{
    ///use HasFactory;
    public $timestamp = false;
    public $table = "companies";
    /*

    create table companies(
        id int(10) not null auto_increment,
        name varchar(128),
        phone_number varchar(128),
        email varchar(128),
        address varchar(1028),
        primary key(id)
    );

    */
}
