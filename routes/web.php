<?php

use App\Livewire\FormPendaftaranPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/daftar', FormPendaftaranPage::class)->name('daftar');
