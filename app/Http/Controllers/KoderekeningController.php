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
use App\Models\Koderekening;

class KoderekeningController extends Controller
{
    public function view(){

        $koderekening = Koderekening::all();

        return view('admin.koderekening.view', compact('koderekening'));
    }

    public function store(Request $request){

        $id_rekening = Koderekening::latest('id_rekening')->first();

        $kodeobjek ="rek";

        if($id_rekening == null){
            $nomorurut = "00001";
        }else{
            $nomorurut = substr($id_rekening->id_rekening, 3, 5) + 1;
            $nomorurut = str_pad($nomorurut, 5, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $koderekening = $request->koderekening;
        $rekening     = $request->rekening;

        $data = [
            'id_rekening'    => $id,
            'kd_rekening'    => $koderekening,
            'nm_rekening'    => $rekening,
            'status'         => '1'
        ];
        $simpan = Koderekening::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    public function edit(Request $request){

        $id_rekening   = $request->id_rekening;
        $id_rekening   = Crypt::decrypt($id_rekening);

        $koderekening  = Koderekening::where('id_rekening', $id_rekening)->first();

        return view('admin.koderekening.edit', compact('koderekening'));

    }
    
    
}
