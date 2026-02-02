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
        Schema::create('tb_perjadin', function (Blueprint $table) {
            $table->string('id_perjadin', 10)->primary();
            $table->string('id_anggaran', 6);
            $table->text('keperuan');
            $table->string('tujuan', 50);
            $table->date('tgl_berangkat');
            $table->date('tgl_pulang');
            $table->decim('pagu', 9,2);
            $table->tinyInteger('tipe');
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
        Schema::dropIfExists('tb_perjadin');
    }
};
