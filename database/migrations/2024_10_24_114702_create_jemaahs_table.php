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
        Schema::create('jemaah', function (Blueprint $table) {
            $table->id();

            $table->string('nama_ktp', 100);
            $table->char('kelamin', 1);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir', 100);
            $table->char('no_hp', 20);
            $table->string('email', 100)->nullable();
            $table->char('nik', 20)->unique();
            $table->string('foto_ktp', 50);
            
            $table->string('nama_paspor', 100)->nullable();
            $table->char('no_paspor', 20)->nullable();
            $table->string('foto_paspor', 50)->nullable();
            $table->date('berlaku_paspor')->nullable();
            
            $table->string('alamat', 100);
            $table->string('kelurahan', 50);
            $table->string('kecamatan', 50);
            $table->string('kabupaten', 50);
            $table->string('provinsi', 50);

            $table->tinyInteger('status_nikah');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jemaah');
    }
};
