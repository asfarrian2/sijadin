<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Perjalanandinas;
use App\Models\Pegawai;

class Rperjadin extends Model
{
    protected $table='tb_rperjadin';
    protected $fillable = ['id_rperjadin', 'id_perjadin', 'id_pegawai', 'uang_harian', 'uang_transportasi', 'uang_penginapan', 'penginapan', 'maskapaib', 'bandarab', 'no_tiketb', 'no_bookingb', 'uang_pesawatb', 'maskapaip', 'bandarap', 'no_tiketp', 'no_bookingp', 'uang_pesawatp'];

    public function perjadin()
    {
        return $this->belongsTo(Perjalanandinas::class, 'id_perjadin', 'id_perjadin');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

}
