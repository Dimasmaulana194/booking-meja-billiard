<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'mejas';
    protected $fillable = [
        'nama',
        'harga_per_jam',
        'asal',
        'deskripsi',
        'gambar',
    ];
}
