<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan as ModelsKaryawan;
use App\Models\Lokasi;
use App\Models\Shift;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Karyawan extends Controller
{
    function index() {
        $gedung = Lokasi::all();
        $jabatan = Jabatan::all();
        $shift = Shift::all();

        $karyawan = ModelsKaryawan::with("jabatan")->with("user")->with("shift")->with("lokasi")->get();
        return view("pages.dashboard.karyawan.index", [
            "gedung" => $gedung,
            "jabatan" => $jabatan,
            "shift" => $shift,
            "karyawan" => $karyawan,
        ]);
    }
    function updateView($id) {
        $gedung = Lokasi::all();
        $jabatan = Jabatan::all();
        $shift = Shift::all();
        $karyawan = ModelsKaryawan::with("jabatan")->with("user")->with("shift")->with("lokasi")->where("id", $id)->first();
        return view("pages.dashboard.karyawan.update", [
            "gedung" => $gedung,
            "jabatan" => $jabatan,
            "shift" => $shift,
            "karyawan" => $karyawan
        ]);
    }
    function update(Request $request) {
        try {
            $karyawan = ModelsKaryawan::find($request->id);
            $karyawan->nama = $request->nama;
            $karyawan->jabatan_id = $request->jabatan_id;
            $karyawan->shift_id = $request->shift_id;
            $karyawan->lokasi_id = $request->lokasi_id;
            $karyawan->save();
            return back()->with("success", "Update berhasil!");
        }catch(Exception $e) {
            return back()->with("danger", $e->getMessage());
        }
    }

    function add( Request $request ) {
        try {
            $karyawan = [
                "nama" => $request->nama,
                "alamat" => $request->alamat,
                "jabatan_id" => $request->jabatan_id,
                "shift_id" => $request->shift_id,
                "lokasi_id" => $request->lokasi_id,
            ];
            $ressEmploye = ModelsKaryawan::create($karyawan);
            
            $user = [
                "email" => $request->email,
                "is_karyawan" => true,
                "name" => $request->name,
                "password" => Hash::make($request->password),
                "karyawan_id" => $ressEmploye->id
            ];
            User::create($user);

            return back()->with("success", "Karyawan berhasil ditambahkan !");
        }catch(Exception $e) {
            return back()->with("danger", $e->getMessage());
        }
    }
    function remove($id) {
        try {
            $karyawan = ModelsKaryawan::find($id)->first();
            $user = User::where("karyawan_id", $id)->firstOrFail();
            User::destroy($user->id);
            ModelsKaryawan::destroy($karyawan->id);
            return back()->with("success", "Karyawan berhasil dihapus!");
        }catch(Exception $e) {
            return back()->with("danger", $e->getMessage());
        }
    }
}
