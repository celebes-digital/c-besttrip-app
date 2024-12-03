<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

class Paket extends Model
{
    use SoftDeletes;

    protected $table = 'paket';

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'tgl_paket',
        'foto',
        'kuota',
        'terisi',
        'is_active',
        'kode_paket',
        'no_wa_admin',
    ];
    
    protected $casts = [
        'tgl_paket' => 'date',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->kode_paket = self::generateKodePaket();
        });
    }

    public static function generateKodePaket(): string
    {
        do {
            $kodePaket = Str::random(8);
        } while (JemaahPaket::where('kode_paket', $kodePaket)->exists());

        return $kodePaket;
    }

    public function getTglPaketAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d F Y');
    }

    public function jemaahs(): BelongsToMany
    {
        return $this->belongsToMany(Jemaah::class, 'jemaah_paket', 'paket_id', 'jemaah_id')
            ->using(JemaahPaket::class)
            ->withTimestamps();
    }

    public function jemaahPaket(): HasMany
    {
        return $this->hasMany(JemaahPaket::class);
    }

    public function itenaryPakets(): HasMany
    {
        return $this->hasMany(IntenaryPaket::class);
    }
}
