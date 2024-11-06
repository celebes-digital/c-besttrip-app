<?php

namespace App\Livewire;

use App\Models\JemaahPaket;
use Livewire\Component;

class CekJemaahPaket extends Component
{
    public JemaahPaket $data;

    public function mount($kode_paket)
    {
        $this->data = JemaahPaket::where('kode_paket', $kode_paket)->firstOrFail();
    }
    
    public function render()
    {
        return view('livewire.cek-jemaah-paket');
    }
}
