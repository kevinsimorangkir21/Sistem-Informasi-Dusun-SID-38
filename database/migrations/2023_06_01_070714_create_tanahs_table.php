<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanahs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('nama_terbaru');
            $table->string('nama_sebelumnya')->nullable();
            $table->string('luas_tanah');
            $table->string('luas_bangunan');
            $table->string('perubahan')->nullable();
            $table->text('keterangan');
            // $table->text('geolocation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanahs');
    }
};
