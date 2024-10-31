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

            $table->foreignId('jemaah_id')->constrained('jemaah');
            $table->foreignId('paket_id')->constrained('paket');
            $table->boolean('status_pembayaran')->default(0);

            $table->softDeletes();
            $table->timestamps();
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
