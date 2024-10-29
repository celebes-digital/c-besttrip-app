<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
    use SoftDeletes;

    protected $table = 'paket';

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'foto',
        'tgl_paket',
    ];
    
    protected $casts = [
        'tgl_paket' => 'date',
    ];
}
