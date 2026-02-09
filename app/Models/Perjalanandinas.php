<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anggaran;
use App\Models\Rperjadin;


class Perjalanandinas extends Model
{
    protected $table='tb_perjadin';
    protected $fillable = ['id_perjadin', 'id_anggaran', 'dasar', 'keperluan', 'tujuan', 'tgl_berangkat', 'tgl_pulang', 'jenis', 'tipe', 'status', 'pengguna'];

    public function anggaran()
    {
        return $this->belongsTo(Anggaran::class, 'id_anggaran', 'id_anggaran');
    }

     public function rperjadin()
    {
        return $this->hasMany(Rperjadin::class, 'id_perjadin', 'id_perjadin');
    }
}
