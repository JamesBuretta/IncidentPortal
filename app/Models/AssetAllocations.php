<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetAllocations extends Model{
    ///use HasFactory;
    public $timestamp = false;
    public $table = "asset_allocations";
    /*

    create table asset_allocations(
        id int(10) not null auto_increment,
        dispatch_date varchar(25),
        allocation_type varchar(25),
        station_id int(10),
        status varchar(10),
        asset_id int(10),
        primary key(id)
    );

    alocation type can be allocated or disallocated
    allocated: Means that the asset was not allocated and sent to the company
    disallocate: Means that the asset was allocated and returned due to any reason
    */


    public function station(){
        return $this->belongsTo(Stations::class,'station_id', 'id');
    }

    public function asset(){
        return $this->belongsTo(Assets::class,'asset_id', 'id');
    }
}
