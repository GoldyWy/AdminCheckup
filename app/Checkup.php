<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    protected $fillable = [
        'id','id_pasien','id_checkup','id_jns_checkup','kode_pembayaran','laporan_checkup','lunas','created_at','updated_at'
    ];

    // public function pembayaran()
    // {
    //     return $this->belongsTo('App\Pembayaran','kode_pembayaran');
    // }
    //
    // public function pasien()
    // {
    //     return $this->belongsTo('App\Pasien','id');
    // }
    // public function jnscheckup()
    // {
    //     return $this->belongsTo('App\Jnscheckup','id');
    // }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function jnscheckup()
    {
        return $this->belongsTo(Jnscheckup::class);
    }

}
