<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

class JemaahPaket extends Model
{
    use SoftDeletes;

    protected $table = 'jemaah_paket';

    protected $fillable = [
        'jemaah_id',
        'kode_paket',
        'paket_id',
        'status_pendaftaran',
        'tgl_pendaftaran',
    ];

    protected $casts = [
        'tgl_pendaftaran' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($jemaahPaket) {
            $jemaahPaket->kode_paket = self::generateKodePaket();
        });
    }

    public static function generateKodePaket(): string
    {
        do {
            $kodePaket = Str::random(8);
        } while (JemaahPaket::where('kode_paket', $kodePaket)->exists());

        return $kodePaket;
    }

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
