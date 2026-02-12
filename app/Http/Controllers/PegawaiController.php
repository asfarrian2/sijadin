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

class PegawaiController extends Controller
{
    public function view() {

        $pegawai = Pegawai::all();

        return view('admin.pegawai.view', compact('pegawai'));
    }

    public function store(Request $request){

        $id_pegawai = Pegawai::where('jenis', '1')->latest('id_pegawai')->first();

        $kodeobjek ="asn-";

        if($id_pegawai == null){
            $nomorurut = "00000000001";
        }else{
            $nomorurut = substr($id_pegawai->id_pegawai, 4, 15) + 1;
            $nomorurut = str_pad($nomorurut, 15, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama           = $request->nama;
        $nip            = $request->nip;
        $pangkgol       = $request->pangkgol;
        $jabatan        = $request->jabatan;
        $kelas          = $request->kelas;

        $data = [
            'id_pegawai' => $id,
            'nama'       => $nama,
            'nip'        => $nip,
            'pangkgol'   => $pangkgol,
            'jabatan'    => $jabatan,
            'kelas'      => $kelas,
            'jenis'      => '0',
            'status'     => '1'
        ];
        $simpan = Pegawai::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    //Tampilkan Halaman Edit Data
    public function edit(Request $request){

        $id_pegawai   = $request->id_pegawai;
        $id_pegawai   = Crypt::decrypt($id_pegawai);

        $pegawai    = Pegawai::where('id_pegawai', $id_pegawai)->first();

        return view('admin.pegawai.edit', compact('pegawai'));

    }

    public function update(Request $request){

        $id_pegawai   = $request->id;
        $id_pegawai   = Crypt::decrypt($id_pegawai);
        $nama         = $request->nama;
        $nip          = $request->nip;
        $pangkgol     = $request->pangkgol;
        $jabatan      = $request->jabatan;

        $data       = [
            'nama'       => $nama,
            'nip'        => $nip,
            'pangkgol'   => $pangkgol,
            'jabatan'    => $jabatan
        ];

        $update = Pegawai::where('id_pegawai', $id_pegawai)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function status($id_pegawai){

        $id_pegawai   = Crypt::decrypt($id_pegawai);
        $pegawai      = Pegawai::where('id_pegawai', $id_pegawai)->first();

        $status     = $pegawai->status;

        if($status == 0){
            $data = [
                'status' => '1'
            ];
        }else{
            $data = [
                'status' => '0'
            ];
        }

        $update = Pegawai::where('id_pegawai',$id_pegawai)->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Status Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Status Data Gagal Diubah']);
        }
    }

        public function hapus($id_pegawai){

        $id_pegawai = Crypt::decrypt($id_pegawai);

        $delete = Pegawai::where('id_pegawai',$id_pegawai)->delete();

        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

}