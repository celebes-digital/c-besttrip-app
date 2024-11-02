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
            $table->char('nik', 20)->unique();
            $table->char('kelamin', 1);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->char('no_hp', 20);
            $table->string('email', 100)->nullable();
            $table->char('foto_ktp', 100);
            
            $table->string('nama_paspor', 100)->nullable();
            $table->char('no_paspor', 20)->nullable();
            $table->char('foto_paspor', 100)->nullable();
            $table->date('berlaku_paspor')->nullable();
            
            $table->string('alamat', 100);
            $table->string('kelurahan', 50);
            $table->string('kecamatan', 50);
            $table->string('kabupaten', 50);
            $table->string('provinsi', 50);
            $table->char('rt', 3);
            $table->char('rw', 3);

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
