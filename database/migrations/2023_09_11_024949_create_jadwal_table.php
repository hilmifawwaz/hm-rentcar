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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id('id_jadwal');
            // $table->bigInteger('id_member');
            $table->bigInteger('id_mobil');
            $table->string('nama_pelanggan');
            $table->dateTime('mulai');
            $table->dateTime('selesai');
            $table->string('harga');
            $table->string('jaminan');
            $table->enum('status', ['booking', 'proses', 'selesai']);
            $table->enum('status_pembayaran', ['0', '1', '2']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
};
