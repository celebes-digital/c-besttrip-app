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
        Schema::create('setoran_jemaah', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paket_jemaah_id')->constrained('paket_jemaah');

            $table->unsignedInteger('nominal');
            $table->datetime('waktu_setor');
            $table->string('bukti_setor', 50);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setoran_jemaah');
    }
};
