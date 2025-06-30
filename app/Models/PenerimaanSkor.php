<?php

// app/Models/PenerimaanSkor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaanSkor extends Model
{
    protected $table = 'penerimaan_skor';
    protected $guarded = [];
    public $timestamps = false; // karena tidak ada created_at/updated_at
}

