<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SetoranJemaah extends Model
{
    use SoftDeletes;

    protected $table = 'setoran_jemaah';

    protected $fillable = [
        'jemaah_paket_id',
        'nominal',
        'waktu_setor',
        'bukti_setor',
        'status_setoran'
    ];

    protected $casts = [
        'tgl_setor' => 'datetime',
        'status_setoran' => 'boolean'
    ];

    public function jemaahPaket()
    {
        return $this->belongsTo(JemaahPaket::class);
    }
}
