<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $table = 'keluarga';
    public $timestamps = false;

    protected $fillable = [
        'user_nik',
        'jumlah_anak',
    ];
}
