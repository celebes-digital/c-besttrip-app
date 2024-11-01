<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JemaahPaket extends Model
{
    use SoftDeletes;

    protected $table = 'jemaah_paket';

    protected $fillable = [
        'jemaah_id',
        'paket_id',
        'status_pembayaran',
    ];

    public function jemaah()
    {
        return $this->belongsTo(Jemaah::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function setoranJemaah(): HasMany
    {
        return $this->hasMany(SetoranJemaah::class);
    }
}
