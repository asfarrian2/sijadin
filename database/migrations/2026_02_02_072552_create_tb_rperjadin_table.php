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
            $table->string('id_rperjadin', 17)->primary();
            $table->string('id_perjadin', 10);
            $table->string('id_pegawai', 7);
            $table->decimal('uang_harian', 10,2)->nullable();
            $table->decimal('uang_transportasi', 10,2)->nullable();
            $table->decimal('uang_penginapan', 10,2)->nullable();
            $table->string('penginapan', 100)->nullable();
            $table->string('maskapaib', 80)->nullable();
            $table->string('bandarab', 80)->nullable();
            $table->string('no_tiketb', 30)->nullable();
            $table->string('no_bookingb', 30)->nullable();
            $table->decimal('uang_pesawatb', 10,2)->nullable();
            $table->string('maskapaip', 80)->nullable();
            $table->string('bandarap', 80)->nullable();
            $table->string('no_tiketp', 30)->nullable();
            $table->string('no_bookingp', 30)->nullable();
            $table->decimal('uang_pesawatp', 10,2)->nullable();
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
