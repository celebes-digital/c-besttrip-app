<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntenaryPaket extends Model
{
    protected $table    = 'intenary_paket';
    protected $fillable = ['paket_id', 'hari_ke', 'kegiatan'];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
