<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JemaahPaket extends Model
{
    use SoftDeletes;

    protected $table = 'jemaah_paket';

    protected $fillable = [
        'jemaah_id',
        'paket_id',
        'status_pendaftaran',
        'tgl_pendaftaran',
    ];

    protected $casts = [
        'tgl_pendaftaran' => 'date',
    ];

    public function jemaah(): BelongsTo
    {
        return $this->belongsTo(Jemaah::class, 'jemaah_id', 'id');
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id');
    }

    public function setoranJemaah(): HasMany
    {
        return $this->hasMany(SetoranJemaah::class, 'jemaah_paket_id', 'id');
    }
}
