<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'id','nama_pasien','tgl_lahir','created_at','updated_at'
    ];

    // public function checkup()
    // {
    //     return $this->hasMany('App\Checkup', 'id_pasien');
    // }

    public function checkup()
    {
        return $this->hasMany(Checkup::class);
    }
}
