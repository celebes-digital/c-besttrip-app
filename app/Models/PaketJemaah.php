<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketJemaah extends Model
{
    use SoftDeletes;

    protected $table = 'paket_jemaah';

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
}
