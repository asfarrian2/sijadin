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
        Schema::create('tb_rperjadin', function (Blueprint $table) {
            $table->string('id_rperjadin', 10)->primary();
            $table->string('id_pegawai', 7);
            $table->decim('uang_harian', 9,2)->nullable();
            $table->decim('uang_transportasi', 9,2)->nullable();
            $table->decim('uang_penginapan', 9,2)->nullable();
            $table->string('nama_penginapan', 50)->nullable();
            $table->text('nota_penginapan')->nullable();
            $table->decim('uang_pes_berangkat', 9,2)->nullable();
            $table->string('bandara_keberangkatan', 7)->nullable();
            $table->string('maskapai_berangkat', 50)->nullable();
            $table->string('booking_pes_berangkat', 50)->nullable();
            $table->string('tiket_pes_berangkat', 50)->nullable();
            $table->text('nota_tiket_berangkat')->nullable();
            $table->decim('uang_pes_kepulangan', 9,2)->nullable();
            $table->string('bandara_kepulangan', 7)->nullable();
            $table->string('maskapai_kepulangan', 50)->nullable();
            $table->string('booking_pes_kepulangan', 50)->nullable();
            $table->string('tiket_pes_kepulangan', 50)->nullable();
            $table->text('nota_tiket_kepulangan')->nullable();
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
        Schema::dropIfExists('tb_rperjadin');
    }
};
