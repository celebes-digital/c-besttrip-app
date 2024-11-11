<?php

use App\Livewire\CekJemaahPaket;
use App\Livewire\FormPendaftaranPage;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/daftar', FormPendaftaranPage::class)->name('daftar');

Route::get('/jemaah/{kode_paket}/paket', CekJemaahPaket::class)->name('jemaah.paket');
