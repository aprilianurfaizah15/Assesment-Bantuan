<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $fillable = [
        'user_nik',
        'jenis_kendaraan',
        'jumlah_kendaraan',
    ];
}
