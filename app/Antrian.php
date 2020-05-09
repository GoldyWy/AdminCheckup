<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $fillable = [
        'id','nomor_antrian','id_checkup','id_jns_checkup','status','created_at','updated_at'
    ];
}
