<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jnscheckup extends Model
{
    protected $fillable = [
        'id','kode_jns_checkup','nama_jns_checkup','harga','status','created_at','updated_at'
    ];

    // public function checkup()
    // {
    //     return $this->hasMany('App\Checkup');
    // }

    public function checkup()
    {
        return $this->hasMany(Checkup::class);
    }
}
