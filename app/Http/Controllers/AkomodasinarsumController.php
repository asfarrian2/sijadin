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
use App\Models\Pegawai;
use App\Models\Rperjadin;
use App\Models\Tahun;

class AkomodasinarsumController extends Controller
{
    public function view_admin(){
        $id_tahun = Auth::user()->id_tahun;
        $dpa      = Dpa::where('id_tahun', $id_tahun)->get();

        $perjadin = Perjalanandinas::whereHas('anggaran.dpa', function($query) use ($id_tahun) {
                    $query->where('id_tahun', $id_tahun);
                    })->where('pengguna','2')->orderby('id_perjadin', 'DESC')->get();
        
        $rperjadin= Rperjadin::all();

        return view('admin.akomodasi.view', compact('perjadin', 'dpa', 'rperjadin'));
    }

    public function store(Request $request){

        $idtahun = Auth::user()->id_tahun;
        $tahun   = Tahun::where('id_tahun',$idtahun)->first();
        $tahun   = $tahun->tahun;


        $id_perjadin = Perjalanandinas::where('pengguna', '2')->latest('id_perjadin')->first();

        $kodeobjek ="ak".$tahun."-";

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
            'pengguna'       => '2',
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
        $id_tahun      = Auth::user()->id_tahun;
        $dpa           = Dpa::where('id_tahun', $id_tahun)->get();

        $perjadin  = Perjalanandinas::where('id_perjadin', $id_perjadin)->first();
        $idanggaran= $perjadin->id_anggaran;
        $anggaran  = Anggaran::where('id_anggaran', $idanggaran)->first();
        $id_dpa    = $anggaran->id_dpa;

        return view('admin.akomodasi.edit', compact('perjadin', 'dpa', 'id_dpa'));

    }

    public function update(Request $request){

        $id_perjadin   = $request->id;
        $id_perjadin   = Crypt::decrypt($id_perjadin);
        $anggaran     = $request->anggaran;
        $dasar        = $request->dasar;
        $keperluan    = $request->keperluan;
        $tujuan       = $request->tujuan;
        $tgl_berangkat= $request->tgl_berangkat;
        $tgl_pulang   = $request->tgl_pulang;
        $jenis        = $request->jenis;

        $data       = [
            'id_anggaran'    => $anggaran,
            'dasar'          => $dasar,
            'keperluan'      => $keperluan,
            'tujuan'         => $tujuan,
            'tgl_berangkat'  => $tgl_berangkat,
            'tgl_pulang'     => $tgl_pulang,
            'jenis'          => $jenis
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
        $subkegiatan   = Perjalanandinas::where('id_perjadin', $id_perjadin)->first();

        $status     = $subkegiatan->status;

        if($status == 0){
            $data = [
                'status' => '1'
            ];
        }elseif($status == 1){
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

    public function add_narsum(Request $request){

        $id_perjadin   = $request->id_perjadin;
        $id_perjadin   = Crypt::decrypt($id_perjadin);

         $pegawai = Pegawai::where('status', '1')->where('jenis', '1')
        ->whereNotIn('id_pegawai', function($query) use ($id_perjadin) {
            $query->select('id_pegawai')
                ->from('tb_rperjadin')
                ->where('id_perjadin', $id_perjadin);
        })
        ->orderby('kelas', 'asc')->get();

        return view('admin.akomodasi.addnarsum', compact('pegawai', 'id_perjadin'));
    }

    public function SimpanNarsum(Request $request){

        $idtahun = Auth::user()->id_tahun;
        $tahun   = Tahun::where('id_tahun',$idtahun)->first();
        $tahun   = $tahun->tahun;


        $id_rperjadin = Rperjadin::whereYear('created_at', $tahun)->latest('id_rperjadin')->first();

        $kodeobjek =$tahun."-rp-";

        if($id_rperjadin == null){
            $nomorurut = "00000001";
        }else{
            $nomorurut = substr($id_rperjadin->id_rperjadin, 8, 8) + 1;
            $nomorurut = str_pad($nomorurut, 8, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $id_perjadin  = $request->id_perjadin;
        $id_perjadin  = Crypt::decrypt($id_perjadin);
        $id_pegawai   = $request->narsum;
        $id_pegawai  = Crypt::decrypt($id_pegawai);

        
        $data = [
            'id_rperjadin'   => $id,
            'id_perjadin'    => $id_perjadin,
            'id_pegawai'     => $id_pegawai
        ];
        $simpan = Rperjadin::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

        public function list_narsum(Request $request){

        $id_perjadin   = $request->id_perjadin;
        $id_perjadin   = Crypt::decrypt($id_perjadin);

        $perjadin      = Perjalanandinas::where('id_perjadin', $id_perjadin)->first();

        $status        = $perjadin->status;

        $rperjadin     = Rperjadin::where('id_perjadin', $id_perjadin)
                         ->orderBy(
                            Pegawai::select('kelas')
                                ->whereColumn('tb_pegawai.id_pegawai', 'tb_rperjadin.id_pegawai')
                            )
                        ->get();

        $pegawai       = Pegawai::all();

        return view('admin.akomodasi.listnarsum', compact('pegawai', 'id_perjadin', 'rperjadin', 'pegawai', 'status'));
        
    }

}
