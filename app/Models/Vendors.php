<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendors extends Model{
    ///use HasFactory;
    public $timestamp = false;
    public $table = "vendors";
    /*

    create table vendors(
        id int(10) not null auto_increment,
        name varchar(100),
        phone_number int(100),
        email_address varchar(1028),
        description varchar(1028),
        primary key(id)
    );

    */
}
