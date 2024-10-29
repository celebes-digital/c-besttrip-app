<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jemaah extends Model
{
    use SoftDeletes;
    
    protected $table = 'jemaah';

    protected $fillable = [
        'nama_ktp',
        'kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'no_hp',
        'email',
        'nik',
        'foto_ktp',
        'nama_passport',
        'no_passport',
        'foto_passport',
        'berlaku_passport',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'status_nikah',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'berlaku_passport' => 'date',
    ];

    public function jemaahPaket()
    {
        return $this->hasMany(JemaahPaket::class, 'jemaah_id', 'id');
    }
}
