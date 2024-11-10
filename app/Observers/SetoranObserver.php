<?php

namespace App\Observers;

use App\Models\JemaahPaket;
use App\Models\SetoranJemaah;

class SetoranObserver
{
    protected function upsateStatusSetoran(SetoranJemaah $setoranJemaah): void
    {
        $jumlahSetoran      = SetoranJemaah::where('jemaah_paket_id', $setoranJemaah->jemaah_paket_id)
                                ->where('status_setoran', 'Terverifikasi')->sum('nominal');

        $hargaPaket         = $setoranJemaah->jemaahPaket->paket->harga;

        $statusPendaftaran  = 0;

        if ($jumlahSetoran >= $hargaPaket) {
            $statusPendaftaran = 1;
        }

        $jemaahPaket = JemaahPaket::where('id', $setoranJemaah->jemaah_paket_id)->update([
            'status_pendaftaran' => $statusPendaftaran,
        ]);
    }

    /**
     * Handle the SetoranJemaah "created" event.
     */
    public function created(SetoranJemaah $setoranJemaah): void
    {
        $this->upsateStatusSetoran($setoranJemaah);
    }

    /**
     * Handle the SetoranJemaah "updated" event.
     */
    public function updated(SetoranJemaah $setoranJemaah): void
    {
        $this->upsateStatusSetoran($setoranJemaah);
    }

    /**
     * Handle the SetoranJemaah "deleted" event.
     */
    public function deleted(SetoranJemaah $setoranJemaah): void
    {
        $this->upsateStatusSetoran($setoranJemaah);
    }

    /**
     * Handle the SetoranJemaah "restored" event.
     */
    public function restored(SetoranJemaah $setoranJemaah): void
    {
        $this->upsateStatusSetoran($setoranJemaah);
    }

    /**
     * Handle the SetoranJemaah "force deleted" event.
     */
    public function forceDeleted(SetoranJemaah $setoranJemaah): void
    {
        $this->upsateStatusSetoran($setoranJemaah);
    }
}
