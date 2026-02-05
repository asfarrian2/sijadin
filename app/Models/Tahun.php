<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dpa;

class Tahun extends Model
{
    protected $table='tb_tahun';
    protected $fillable = ['id_tahun', 'tahun', 'status'];

     public function dpa()
    {
        return $this->hasMany(Dpa::class, 'id_tahun', 'id_tahun');
    }
}
