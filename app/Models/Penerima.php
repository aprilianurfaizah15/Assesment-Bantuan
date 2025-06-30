<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    protected $table = 'penerima';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'no_hp',
    ];
}
