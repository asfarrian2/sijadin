<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;
use App\Models\Subkegiatan;
use App\Models\Koderekening;


class Anggaran extends Model
{
    protected $table='tb_anggaran';
    
    protected $fillable = ['id_anggaran', 'id_dpa', 'id_subkegiatan', 'id_rekening', 'id_pegawai', 'pagu'];

     public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

   public function subkegiatan()
    {
        return $this->belongsTo(Subkegiatan::class, 'id_subkegiatan', 'id_subkegiatan');
    }

    public function koderekening()
    {
        return $this->belongsTo(Koderekening::class, 'id_rekening', 'id_rekening');
    }
}
