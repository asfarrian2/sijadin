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
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Perjalanandinas;
use App\Models\Anggaran;
use App\Models\Dpa;
use App\Models\Subkegiatan;
use App\Models\Koderekening;
use App\Models\Pegawai;
use App\Models\Rperjadin;
use App\Models\Tahun;

class PerjalanandinasController extends Controller
{
    public function view_admin(){

        $id_tahun = Auth::user()->id_tahun;
        $dpa      = Dpa::where('id_tahun', $id_tahun)->get();

        $perjadin = Perjalanandinas::whereHas('anggaran.dpa', function($query) use ($id_tahun) {
                    $query->where('id_tahun', $id_tahun);
                    })->orderby('id_perjadin', 'DESC')->get();
        
        $rperjadin= Rperjadin::all();

        return view('admin.perjadin.view', compact('perjadin', 'dpa', 'rperjadin'));

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
        $id_tahun      = Auth::user()->id_tahun;
        $dpa           = Dpa::where('id_tahun', $id_tahun)->get();

        $perjadin  = Perjalanandinas::where('id_perjadin', $id_perjadin)->first();
        $idanggaran= $perjadin->id_anggaran;
        $anggaran  = Anggaran::where('id_anggaran', $idanggaran)->first();
        $id_dpa    = $anggaran->id_dpa;

        return view('admin.perjadin.edit', compact('perjadin', 'dpa', 'id_dpa'));

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

    public function add_pegawai(Request $request){

        $id_perjadin   = $request->id_perjadin;
        $id_perjadin   = Crypt::decrypt($id_perjadin);

         $pegawai = Pegawai::where('status', '1')
        ->whereNotIn('id_pegawai', function($query) use ($id_perjadin) {
            $query->select('id_pegawai')
                ->from('tb_rperjadin')
                ->where('id_perjadin', $id_perjadin);
        })
        ->orderby('kelas', 'asc')->get();

        return view('admin.perjadin.addpegawai', compact('pegawai', 'id_perjadin'));
    }

    public function list_pegawai(Request $request){

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

        return view('admin.perjadin.listpegawai', compact('pegawai', 'id_perjadin', 'rperjadin', 'pegawai', 'status'));
        
    }

    public function hapusPegawai(Request $request)
    {
        try {
            DB::beginTransaction();

            if (!$request->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada data yang dipilih'
                ]);
            }

            foreach ($request->id as $encryptedId) {
                $id = Crypt::decrypt($encryptedId);

                Rperjadin::where('id_rperjadin', $id)->delete();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }



    public function simpanPegawai(Request $request)
    {
        try {
            DB::beginTransaction();
    
            // =====================
            // Ambil & decrypt data
            // =====================
            $id_perjadin = Crypt::decrypt($request->id_perjadin);
            $pegawai_id  = $request->pegawai_id;
            $id_tahun    = Auth::user()->id_tahun;
    
            // =====================
            // Prefix kode
            // =====================
            $prefix = $id_tahun . '-RP-';
    
            // =====================
            // Ambil ID terakhir DENGAN LOCK
            // =====================
            $lastId = Rperjadin::where('id_rperjadin', 'like', $prefix . '%')
                ->orderBy('id_rperjadin', 'desc')
                ->lockForUpdate()
                ->value('id_rperjadin');
    
            // =====================
            // Tentukan nomor urut
            // =====================
            if ($lastId) {
                $nomorurut = (int) substr($lastId, -5) + 1;
            } else {
                $nomorurut = 1;
            }
    
            // =====================
            // Simpan data pegawai
            // =====================
            foreach ($pegawai_id as $id_pegawai) {
    
                $kode = $prefix . str_pad($nomorurut, 5, '0', STR_PAD_LEFT);
    
                Rperjadin::create([
                    'id_rperjadin' => $kode,
                    'id_perjadin'  => $id_perjadin,
                    'id_pegawai'  => Crypt::decrypt($id_pegawai),
                ]);
    
                $nomorurut++;
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Data pegawai berhasil disimpan'
            ]);
    
        } catch (\Exception $e) {
    
            DB::rollBack();
    
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function laporanSpt($id_perjadin){

        $id_perjadin = Crypt::decrypt($id_perjadin);

        $perjadin    = Perjalanandinas::where('id_perjadin', $id_perjadin)->first();

        $rperjadin = Rperjadin::where('id_perjadin', $id_perjadin)
                     ->whereHas('pegawai')
                     ->orderBy(
                         Pegawai::select('kelas')
                             ->whereColumn('tb_pegawai.id_pegawai', 'tb_rperjadin.id_pegawai')
                     )
                     ->get();
        
        $pegawai     = Pegawai::all();

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0, 0, 595.28, 935.43], 'potrait', [
            'margin-top' => '0.5in',
            'margin-right' => '0.5in',
            'margin-bottom' => '0.5in',
            'margin-left' => '0.5in',
        ]);
        
        $pdf->loadView('admin.perjadin.spt', compact('perjadin', 'rperjadin', 'pegawai'));


        return $pdf->stream('SPT '.$perjadin->tgl_berangkat.' '.$perjadin->keperluan.' '.$perjadin->tujuan.'.pdf');
    }

    public function laporanSppd($id_rperjadin){

        $id_rperjadin = Crypt::decrypt($id_rperjadin);

        $rperjadin    = Rperjadin::where('id_rperjadin', $id_rperjadin)->first();

        $pdf = App::make('dompdf.wrapper');
        $pdf->setPaper([0, 0, 595.28, 935.43], 'potrait', [
            'margin-top' => '0.5in',
            'margin-right' => '0.5in',
            'margin-bottom' => '0.5in',
            'margin-left' => '0.5in',
        ]);
        
        $pdf->loadView('admin.perjadin.sppd', compact('rperjadin'));


        return $pdf->stream('SPPD '.$rperjadin->pegawai->nama.' '.$rperjadin->perjadin->tgl_berangkat.' '.$rperjadin->perjadin->tujuan.'.pdf');
    }


    
    
}

