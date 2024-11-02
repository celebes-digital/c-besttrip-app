<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id();

            $table->string('nama_paket', 50);
            $table->string('deskripsi', 255)->nullable();
            $table->unsignedInteger('harga');

            $table->date('tgl_paket');
            $table->string('foto', 50)->nullable();
            $table->unsignedSmallInteger('kuota');
            $table->unsignedSmallInteger('terisi')->default(0);
            $table->boolean('is_active')->default(true);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
