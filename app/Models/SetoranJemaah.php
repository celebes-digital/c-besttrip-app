<?php

namespace App\Models;

use App\Enums\StatusSetoran;
use App\Observers\SetoranObserver;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([SetoranObserver::class])]
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
        'waktu_setor'       => 'datetime',
        'status_setoran'    => StatusSetoran::class,
    ];

    public function jemaahPaket(): Relations\BelongsTo
    {
        return $this->belongsTo(JemaahPaket::class, 'jemaah_paket_id', 'id');
    }

    public function jemaah(): Relations\BelongsTo
    {
        return $this->belongsTo(Jemaah::class, 'jemaah_paket_id', 'id');
    }

    public function paket(): Relations\BelongsTo
    {
        return $this->belongsTo(Paket::class, 'jemaah_paket_id', 'id');
    }
}
