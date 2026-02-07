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
use App\Models\Anggaran;
use App\Models\Dpa;
use App\Models\Subkegiatan;
use App\Models\Koderekening;
use App\Models\Pegawai;

class AnggaranController extends Controller
{
    public function view($id_dpa) {

        $id_dpa       = Crypt::decrypt($id_dpa);

        $anggaran     = Anggaran::where('id_dpa', $id_dpa)->get();
        $subkegiatan  = Subkegiatan::where('status', '1')->get();
        $koderekening = Koderekening::where('status', '1')->get();
        $pegawai      = Pegawai::where('status', '1')->get();
        $pptk         = Pegawai::whereHas('anggaran')->get();

        return view('admin.anggaran.view', compact('anggaran', 'subkegiatan', 'koderekening', 'pegawai', 'id_dpa', 'pptk'));
    }

    public function store(Request $request){

        $id_anggaran = Anggaran::latest('id_anggaran')->first();

        $id_dpa = $request->dpa;
        $id_dpa = Crypt::decrypt($id_dpa);


        $kodeobjek =$id_dpa."-R-";

        if($id_anggaran == null){
            $nomorurut = "001";
        }else{
            $nomorurut = substr($id_anggaran->id_anggaran, 12, 3) + 1;
            $nomorurut = str_pad($nomorurut, 3, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $id_subkegiatan = $request->subkegiatan;
        $id_rekening    = $request->koderekening;
        $id_pegawai     = $request->pegawai;
        $pagu           = $request->pagu;
        $pagu           = str_replace('.','', $pagu);

        $data = [
            'id_anggaran'    => $id,
            'id_dpa'         => $id_dpa,
            'id_subkegiatan' => $id_subkegiatan,
            'id_rekening'    => $id_rekening,
            'id_pegawai'     => $id_pegawai,
            'pagu'           => $pagu
        ];
        $simpan = Anggaran::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    //Tampilkan Halaman Edit Data
    public function edit(Request $request){

        $id_dpa        = $request->id_dpa;
        $id_dpa        = Crypt::decrypt($id_dpa);
        $id_pegawai    = $request->id_pegawai;
        $id_pegawai    = Crypt::decrypt($id_pegawai);
        $pegawai       = Pegawai::where('status', '1')->get();

        $dpa         = Dpa::where('id_dpa', $id_dpa)->first();
        $pptk        = Pegawai::where('id_pegawai', $id_pegawai)->first();

        return view('admin.anggaran.edit', compact('dpa', 'pegawai', 'pptk'));

    }

    public function update(Request $request){

        $id_dpa       = $request->dpa;
        $id_dpa       = Crypt::decrypt($id_dpa);
        $id_pegawai   = $request->pegawai;
        $id_pegawai   = Crypt::decrypt($id_pegawai);
        $id_pptk      = $request->pptk;
        $id_pptk      = Crypt::decrypt($id_pptk);

        $data       = [
            'id_pegawai'       => $id_pegawai
        ];

        $update = Anggaran::where('id_pegawai', $id_pptk)->where('id_dpa', $id_dpa)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function status($id_anggaran){

        $id_anggaran   = Crypt::decrypt($id_anggaran);
        $anggaran      = Anggaran::where('id_anggaran', $id_anggaran)->first();

        $status     = $anggaran->status;

        if($status == 0){
            $data = [
                'status' => '1'
            ];
        }else{
            $data = [
                'status' => '0'
            ];
        }

        $update = Anggaran::where('id_anggaran',$id_anggaran)->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Status Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Status Data Gagal Diubah']);
        }
    }

    public function edit_r(Request $request){

        $id_anggaran   = $request->id_anggaran;
        $id_anggaran   = Crypt::decrypt($id_anggaran);

        $anggaran    = Anggaran::where('id_anggaran', $id_anggaran)->first();

        return view('admin.anggaran.editr', compact('anggaran'));

    }

    public function update_r(Request $request){

        $id_anggaran   = $request->id;
        $id_anggaran   = Crypt::decrypt($id_anggaran);
        $pagu           = $request->pagu;
        $pagu           = str_replace('.','', $pagu);

        $data       = [
            'pagu'    => $pagu
        ];

        $update = Anggaran::where('id_anggaran', $id_anggaran)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function hapus($id_anggaran){

        $id_anggaran = Crypt::decrypt($id_anggaran);

        $delete = Anggaran::where('id_anggaran',$id_anggaran)->delete();

        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

}