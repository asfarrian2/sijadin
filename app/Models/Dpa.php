<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tahun;

class Dpa extends Model
{
    protected $table='tb_dpa';
    protected $fillable = ['id_dpa', 'dpa', 'tgl', 'id_tahun', 'status'];

    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'id_tahun', 'id_tahun');
    }
    
}
