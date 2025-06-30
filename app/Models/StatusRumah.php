<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusRumah extends Model
{
    protected $table = 'rumah_tanah';

    protected $fillable = [
        'user_nik', 'status_rumah', 'luas_rumah', 'kondisi_rumah'
    ];
}
