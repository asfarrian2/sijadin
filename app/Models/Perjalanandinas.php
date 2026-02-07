<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjalanandinas extends Model
{
    protected $table='tb_perjadin';
    protected $fillable = ['id_perjadin', 'id_anggaran', 'dasar', 'keperluan', 'tujuan', 'tgl_berangkat', 'tgl_pulang', 'pagu', 'tipe', 'status', 'pengguna'];
}
