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
        Schema::create('intenary_paket', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paket_id')->constrained('paket')->onDelete('cascade');
            $table->unsignedTinyInteger('hari_ke');
            $table->text('kegiatan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intenary_paket');
    }
};
