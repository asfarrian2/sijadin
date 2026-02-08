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
use App\Models\Perjalanandinas;
use App\Models\Anggaran;
use App\Models\Dpa;
use App\Models\Subkegiatan;
use App\Models\Koderekening;
use App\Models\Tahun;

class PerjalanandinasController extends Controller
{
    public function view_admin(){

        $id_tahun = Auth::user()->id_tahun;
        $dpa      = Dpa::where('id_tahun', $id_tahun)->get();

        $perjadin = Perjalanandinas::whereHas('anggaran.dpa', function($query) use ($id_tahun) {
                    $query->where('id_tahun', $id_tahun);
                    })->get();

        return view('admin.perjadin.view', compact('perjadin', 'dpa'));

    }

    public function getSubkegiatan($idDpa)
    {
        $idDpa = Crypt::decrypt($idDpa);
        $anggaran = Anggaran::with('subkegiatan')->with('koderekening')->where('id_dpa', $idDpa)->get();
        return response()->json($anggaran);
    }


    public function store(Request $request){

        $idtahun = Auth::user()->id_tahun;
        $tahun   = Tahun::where('id_tahun',$idtahun)->first();
        $tahun   = $tahun->tahun;


        $id_perjadin = Perjalanandinas::latest('id_perjadin')->first();

        $kodeobjek ="tl".$tahun."-";

        if($id_perjadin == null){
            $nomorurut = "0001";
        }else{
            $nomorurut = substr($id_perjadin->id_perjadin, 7, 4) + 1;
            $nomorurut = str_pad($nomorurut, 4, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $anggaran     = $request->anggaran;
        $dasar        = $request->dasar;
        $keperluan    = $request->keperluan;
        $tujuan       = $request->tujuan;
        $tgl_berangkat= $request->tgl_berangkat;
        $tgl_pulang   = $request->tgl_pulang;
        $jenis        = $request->jenis;
        
        $data = [
            'id_perjadin'    => $id,
            'id_anggaran'    => $anggaran,
            'dasar'          => $dasar,
            'keperluan'      => $keperluan,
            'tujuan'         => $tujuan,
            'tgl_berangkat'  => $tgl_berangkat,
            'tgl_pulang'     => $tgl_pulang,
            'jenis'          => $jenis,
            'pengguna'       => '1',
            'status'         => '0'
        ];
        $simpan = Perjalanandinas::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    public function edit(Request $request){

        $id_perjadin   = $request->id_perjadin;
        $id_perjadin   = Crypt::decrypt($id_perjadin);
        $id_tahun = Auth::user()->id_tahun;
        $dpa      = Dpa::where('id_tahun', $id_tahun)->get();

        $perjadin  = Perjalanandinas::where('id_perjadin', $id_perjadin)->first();
        $idanggaran= $perjadin->id_anggaran;
        $anggaran  = Anggaran::where('id_anggaran', $idanggaran)->first();
        $id_dpa    = $anggaran->id_dpa;

        return view('admin.perjadin.edit', compact('perjadin', 'dpa', 'id_dpa'));

    }

    public function update(Request $request){

        $id_perjadin   = $request->id;
        $id_perjadin   = Crypt::decrypt($id_perjadin);
        $rekening      = $request->subkegiatan;
        $perjadin  = $request->kodesubkegiatan;

        $data       = [
            'kd_rekening'    => $perjadin,
            'nm_rekening'    => $rekening,
        ];

        $update = Perjalanandinas::where('id_perjadin', $id_perjadin)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function status($id_perjadin){

        $id_perjadin   = Crypt::decrypt($id_perjadin);
        $subkegiatan      = Perjalanandinas::where('id_perjadin', $id_perjadin)->first();

        $status     = $subkegiatan->status;

        if($status == 0){
            $data = [
                'status' => '1'
            ];
        }else{
            $data = [
                'status' => '0'
            ];
        }

        $update = Perjalanandinas::where('id_perjadin',$id_perjadin)->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Status Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Status Data Gagal Diubah']);
        }
    }


    public function hapus($id_perjadin){
        $id_perjadin = Crypt::decrypt($id_perjadin);
        $cekAnggaran = Anggaran::where('id_perjadin', $id_perjadin)->first();
        if ($cekAnggaran) {
            return Redirect::back()->with(['warning' => 'Tidak dapat menghapus rekening karena digunakan pada anggaran']);
        } else {
            $delete = Perjalanandinas::where('id_perjadin', $id_perjadin)->delete();
            if ($delete) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
            }
        }
    }
    
    
}

