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
        Schema::create('tb_anggaran', function (Blueprint $table) {
            $table->string('id_anggaran', 6)->primary();
            $table->string('id_tahun', 4);
            $table->string('id_subkegiatan', 4);
            $table->string('id_rekening', 4);
            $table->string('id_pegawai', 7);
            $table->decimal('pagu', 12,9);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('tb_anggaran');
    }
};
