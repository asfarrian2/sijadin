<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use App\Models\Perjalanandinas;
use App\Models\Rperjadin;
use App\Models\Dpa;


class NarsumController extends Controller
{
    public function view_admin(){
        $id_tahun = Auth::user()->id_tahun;
        $dpa      = Dpa::where('id_tahun', $id_tahun)->get();

        $perjadin = Perjalanandinas::whereHas('anggaran.dpa', function($query) use ($id_tahun) {
                    $query->where('id_tahun', $id_tahun);
                    })->where('pengguna','2')->orderby('id_perjadin', 'DESC')->get();
        
        $rperjadin= Rperjadin::all();

        return view('admin.perjadin.narsum.view', compact('perjadin', 'dpa', 'rperjadin'));
    }

}
