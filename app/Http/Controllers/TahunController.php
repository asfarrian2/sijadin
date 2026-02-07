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
use App\Models\Tahun;
use App\Models\Dpa;
use App\Models\Anggaran;

class TahunController extends Controller
{
    public function view() {

        $tahun = Tahun::all();
        $dpa   = Dpa::all();

        return view('admin.tahun.view', compact('tahun', 'dpa'));
    }

    public function store(Request $request){

        $id_tahun = Tahun::latest('id_tahun')->first();

        $kodeobjek ="th-";

        if($id_tahun == null){
            $nomorurut = "001";
        }else{
            $nomorurut = substr($id_tahun->id_tahun, 3, 3) + 1;
            $nomorurut = str_pad($nomorurut, 3, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $tahun     = $request->tahun;

        $data = [
            'id_tahun' => $id,
            'tahun'    => $tahun,
            'status'   => '1'
        ];
        $simpan = Tahun::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    //Tampilkan Halaman Edit Data
    public function edit(Request $request){

        $id_tahun   = $request->id_tahun;
        $id_tahun   = Crypt::decrypt($id_tahun);

        $tahun    = Tahun::where('id_tahun', $id_tahun)->first();

        return view('admin.tahun.edit', compact('tahun'));

    }

    public function update(Request $request){

        $id_tahun   = $request->id;
        $id_tahun   = Crypt::decrypt($id_tahun);
        $tahun      = $request->tahun;

        $data       = [
            'tahun'    => $tahun,
        ];

        $update = Tahun::where('id_tahun', $id_tahun)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function status($id_tahun){

        $id_tahun   = Crypt::decrypt($id_tahun);
        $tahun      = Tahun::where('id_tahun', $id_tahun)->first();

        $status     = $tahun->status;

        if($status == 0){
            $data = [
                'status' => '1'
            ];
        }else{
            $data = [
                'status' => '0'
            ];
        }

        $update = Tahun::where('id_tahun',$id_tahun)->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Status Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Status Data Gagal Diubah']);
        }
    }


    public function hapus($id_tahun){
        $id_tahun = Crypt::decrypt($id_tahun);
        
        // Cek apakah ada DPA yang terkait dengan id_tahun
        if (Dpa::where('id_tahun', $id_tahun)->exists()) {
            return Redirect::back()->with(['warning' => 'Data Tahun Gagal Dihapus karena masih terkait dengan DPA']);
        }
        
        // Jika tidak ada DPA yang terkait, maka hapus data tahun
        $delete = Tahun::where('id_tahun', $id_tahun)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Tahun Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Tahun Gagal Dihapus']);
        }
    }


    //Tambhkan DPA Data
    public function add_dpa(Request $request){

        $id_tahun   = $request->id_tahun;
        $id_tahun   = Crypt::decrypt($id_tahun);

        $tahun      = Tahun::where('id_tahun', $id_tahun)->first();

        return view('admin.tahun.adddpa', compact('tahun'));

    }

    public function store_dpa(Request $request){

        $id_tahun   = $request->tahun;
        $id_tahun   = Crypt::decrypt($id_tahun);

        $id_dpa = Dpa::latest('id_dpa')->first();
        
        $kodeobjek ="dpa-";

        if($id_dpa == null){
            $nomorurut = "00001";
        }else{
            $nomorurut = substr($id_dpa->id_dpa, 4, 5) + 1;
            $nomorurut = str_pad($nomorurut, 5, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $dpa = $request->dpa;
        $tgl = $request->tgl;

        $data = [
            'id_dpa' => $id,
            'dpa'    => $dpa,
            'tgl'    => $tgl,
            'id_tahun' => $id_tahun,
            'status'   => '1'
        ];
        $simpan = Dpa::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    //Tampilkan Halaman Edit Data
    public function edit_dpa(Request $request){

        $id_dpa   = $request->id_dpa;
        $id_dpa   = Crypt::decrypt($id_dpa);

        $dpa      = Dpa::where('id_dpa', $id_dpa)->first();

        return view('admin.tahun.editdpa', compact('dpa'));

    }

    public function update_dpa(Request $request){

        $id_dpa   = $request->id;
        $id_dpa   = Crypt::decrypt($id_dpa);
        $dpa      = $request->dpa;
        $tanggal  = $request->tanggal;

        $data = [
            'dpa'    => $dpa,
            'tgl'    => $tanggal,
        ];

        $update = Dpa::where('id_dpa', $id_dpa)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function hapus_dpa($id_dpa){

        $id_dpa = Crypt::decrypt($id_dpa);

          $cekAnggaran = Anggaran::where('id_dpa', $id_dpa)->first();
          if ($cekAnggaran) {
              return Redirect::back()->with(['warning' => 'Tidak dapat menghapus DPA Karena terdapat Sub Kegiatan']);
          } else {
              $dpa = DPA::find($id_dpa);
              if ($dpa) {
                  $dpa->delete();
                  return Redirect::back()->with(['success' => 'DPA berhasil dihapus']);
              } else {
                  return Redirect::back()->with(['warning' => 'DPA tidak ditemukan']);
              }
          }
}


    
}
