<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anggaran;

class Pegawai extends Model
{
    protected $table='tb_pegawai';
    protected $fillable = ['id_pegawai', 'nama', 'nip', 'pangkgol', 'jabatan', 'status'];

    public function anggaran()
    {
        return $this->hasMany(Anggaran::class, 'id_pegawai', 'id_pegawai');
    }
    
}
