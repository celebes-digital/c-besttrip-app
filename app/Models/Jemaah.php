<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jemaah extends Model
{
    use SoftDeletes;
    
    protected $table = 'jemaah';

    protected $fillable = [
        'nama_ktp',
        'nik',
        'kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'no_hp',
        'email',
        'foto_ktp',
        'nama_paspor',
        'no_paspor',
        'foto_paspor',
        'berlaku_paspor',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'rt',
        'rw',
        'status_nikah',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'berlaku_paspor' => 'date',
    ];

    public function pakets(): BelongsToMany
    {
        return $this->belongsToMany(Paket::class, 'jemaah_paket', 'jemaah_id', 'paket_id')
            ->withPivot('status_pendaftaran', 'tgl_pendaftaran')
            ->withTimestamps();
    }

    public function jemaahPakets(): HasMany
    {
        return $this->hasMany(JemaahPaket::class, 'jemaah_id', 'id');
    }

    public function setorans(): HasManyThrough
    {
        return $this->hasManyThrough(SetoranJemaah::class, JemaahPaket::class, 'jemaah_id', 'jemaah_paket_id', 'id', 'id');
    }
}
