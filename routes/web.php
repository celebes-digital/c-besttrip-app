<?php

use App\Livewire\CekJemaahPaket;
use App\Livewire\FormPendaftaranPage;
use App\Models\Paket;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'paket' => Paket::where('tgl_paket', '>=', now())->where('is_active', true)->get()
    ]);
});

Route::get('/daftar', FormPendaftaranPage::class)->name('daftar');

Route::get('/jemaah/{kode_paket}/paket', CekJemaahPaket::class)->name('jemaah.paket');
