<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SetoranJemaah extends Model
{
    use SoftDeletes;

    protected $table = 'setoran_jemaah';

    protected $fillable = [
        'paket_jemaah_id',
        'nominal',
        'waktu_setor',
        'bukti_setor',
    ];

    protected $casts = [
        'tgl_setor' => 'datetime',
    ];

    public function paketJemaah()
    {
        return $this->belongsTo(PaketJemaah::class);
    }
}
