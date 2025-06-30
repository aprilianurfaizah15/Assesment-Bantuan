<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = 'pekerjaan';
    protected $fillable = [
        'user_nik',
        'jenis_pekerjaan',
        'penghasilan',
    ];
}
