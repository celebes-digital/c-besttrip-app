<?php

namespace App\Models;

use App\Enums\StatusSetoran;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class SetoranJemaah extends Eloquent\Model
{
    use SoftDeletes;

    protected $table = 'setoran_jemaah';

    protected $fillable = [
        'jemaah_paket_id',
        'nominal',
        'waktu_setor',
        'metode_setor',
        'status_setoran',
        'bukti_setor',
        'catatan'
    ];

    protected $casts = [
        'waktu_setor'       => 'datetime',
        'status_setoran'    => StatusSetoran::class,
    ];

    public function jemaahPaket(): Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(JemaahPaket::class, 'jemaah_paket_id', 'id');
    }

    public function jemaah(): Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Jemaah::class, JemaahPaket::class);
    }

    public function paket(): Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Paket::class, JemaahPaket::class);
    }
}
