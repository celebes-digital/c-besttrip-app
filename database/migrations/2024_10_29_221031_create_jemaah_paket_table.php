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
        Schema::create('jemaah_paket', function (Blueprint $table) {
            $table->id();

            $table->char('kode_paket', 8)->unique();
            $table->foreignId('jemaah_id')->constrained('jemaah')->cascadeOnDelete();
            $table->foreignId('paket_id')->constrained('paket')->cascadeOnDelete();
            $table->boolean('status_pendaftaran')->default(0);
            $table->date('tgl_pendaftaran')->default(now());

            $table->softDeletes();
            $table->timestamps();

            $table->unique(['jemaah_id', 'paket_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jemaah_paket');
    }
};
