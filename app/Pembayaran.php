<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'id','kode_pembayaran','total','created_at','updated_at'
    ];

    // public function checkup()
    // {
    //     return $this->hasMany('App\Checkup','kode_pembayaran');
    // }

    public function checkup()
    {
        return $this->hasMany(Checkup::class);
    }
}
