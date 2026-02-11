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
use App\Models\User;
use App\Models\Pegawai;

class UserController extends Controller
{
    public function view_admin(){

        $users   = User::where('role', 'superadmin')->get();
        $pegawai = Pegawai::where('status', '1')->get();

        return view('admin.users.admin', compact('users', 'pegawai'));
    }

    public function view_kpa(){

        $users   = User::where('role', 'kpa')->get();
        $pegawai = Pegawai::where('status', '1')->get();

        return view('admin.users.kpa', compact('users', 'pegawai'));
    }

    public function store(Request $request){

        $id_user = User::latest('id')->first();

        $kodeobjek ="541";

        if($id_user == null){
            $nomorurut = "0001";
        }else{
            $nomorurut = substr($id_user->id, 3, 4) + 1;
            $nomorurut = str_pad($nomorurut, 4, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;


        $pegawai  = $request->pegawai;
        $pegawai  = crypt::decrypt($pegawai);
        $email    = $request->email;
        $password = $request->password;
        $role     = $request->role;

        $data = [
            'id'         => $id,
            'id_pegawai' => $pegawai,
            'email'      => $email,
            'password'   => Hash::make($password),
            'role'       => $role
        ];
        $simpan = User::create($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    public function edit(Request $request){

        $id   = $request->id;
        $id   = Crypt::decrypt($id);

        $users  = User::where('id', $id)->first();

        return view('admin.users.edit', compact('users'));

    }

    public function update(Request $request){

        $id   = $request->id;
        $id   = Crypt::decrypt($id);
        $rekening      = $request->subkegiatan;
        $users  = $request->kodesubkegiatan;

        $data       = [
            'kd_rekening'    => $users,
            'nm_rekening'    => $rekening,
        ];

        $update = User::where('id', $id)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
        }
        
    }

    public function status($id){

        $id   = Crypt::decrypt($id);
        $subkegiatan      = User::where('id', $id)->first();

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

        $update = User::where('id',$id)->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Status Data Berhasil Diubah']);
        } else {
            return Redirect::back()->with(['warning' => 'Status Data Gagal Diubah']);
        }
    }


    public function hapus($id_user){
        $id_user = Crypt::decrypt($id_user);

            $delete = User::where('id_user', $id_user)->delete();
            if ($delete) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
            }
        
    }
    
}

