<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    ];
    
    protected $casts = [
        'tgl_paket' => 'date',
    ];

    public function jemaahs(): BelongsToMany
    {
        return $this->belongsToMany(Jemaah::class, 'jemaah_paket', 'paket_id', 'jemaah_id')
            ->withPivot('status_pendaftaran', 'tgl_pendaftaran')
            ->withTimestamps();
    }

    public function jemaahPaket(): HasMany
    {
        return $this->hasMany(JemaahPaket::class);
    }
}
