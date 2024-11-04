<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class SetoranJemaah extends Model
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
        'waktu_setor' => 'datetime',
        'status_setoran' => 'boolean'
    ];

    public function jemaahPaket(): BelongsTo
    {
        return $this->belongsTo(JemaahPaket::class, 'jemaah_paket_id', 'id');
    }

    public function jemaah(): HasOneThrough
    {
        return $this->hasOneThrough(Jemaah::class, JemaahPaket::class);
    }

    public function paket(): HasOneThrough
    {
        return $this->hasOneThrough(Paket::class, JemaahPaket::class);
    }
}
