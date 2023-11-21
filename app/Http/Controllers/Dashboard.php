<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Lokasi;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    function index() {
        $checkAbsen = [];
        $karyawanProfile = [];
        $shift = [];
        $jabatan = [];
        $lokasi = [];
        if ( Auth::user()->is_karyawan !== null ) {
            $checkAbsen = $this->checkAbsensi();
            $karyawanProfile = User::with("karyawan")->where("id", Auth::user()->id)->first();
            $shift = Shift::find($karyawanProfile->karyawan->shift_id);
            $jabatan = Jabatan::find($karyawanProfile->karyawan->jabatan_id);
            $lokasi = Lokasi::find($karyawanProfile->karyawan->lokasi_id);
        }
        return view("pages.dashboard.index", [
            "checkAbsen" => $checkAbsen,
            "shift" => $shift,
            "jabatan" => $jabatan,
            "lokasi" => $lokasi
        ]);
    }

    function checkAbsensi() {
        $karyawanProfile = User::with("karyawan")->where("id", Auth::user()->id)->firstOrFail();
        $shift = Shift::find($karyawanProfile->karyawan->shift_id);

        $currentTime = Carbon::now();
        $timeNow = $currentTime->hour.":".$currentTime->minute;
        $dateNow = $currentTime->year . "-" . $currentTime->month . "-" . $currentTime->day; 

        $terlambat = "";
        $akanData = "";
        $absesnSekarang = false;
        $belumAbsen = false;
        $countAbsen =  Absensi::where("waktu", $dateNow)->first();
        $countAbsen = ($countAbsen == null)? [] : $countAbsen->toArray();
        
        // rumus jam
        $jam = explode(":", $timeNow)[0] - explode(":", $shift['waktu_mulai'])[0];
        $minute = explode(":", $timeNow)[1] - explode(":", $shift['waktu_mulai'])[1];

        // cek absensi hari ini 
        if ( count($countAbsen) > 0 ) {
            $absesnSekarang = true;
            $akanData = $jam.":".$minute;
        }else {
            $belumAbsen = true;
            $terlambat = $jam.":".$minute;
        }

        return [
            "belum_absen" => $belumAbsen,
            "absen_sekarang" => $absesnSekarang,
            "terlambat" => $terlambat,
            "akan_data" => $akanData,
            "absen" => $countAbsen
        ];
    }
    
    function absenNow() {
        $karyawanProfile = User::with("karyawan")->where("id", Auth::user()->id)->firstOrFail();
        $shift = Shift::find($karyawanProfile->karyawan->shift_id);
        
        $currentTime = Carbon::now();
        $timeNow = $currentTime->hour.":".$currentTime->minute;
        $dateNow = $currentTime->year . "-" . $currentTime->month . "-" . $currentTime->day; 

        $countAbsen =  Absensi::where("waktu", $dateNow)->first();
        $countAbsen = ($countAbsen == null)? [] : $countAbsen->toArray();

        // rumus jam
        $jam = explode(":", $timeNow)[0] - explode(":", $shift['waktu_mulai'])[0];
        $minute = explode(":", $timeNow)[1] - explode(":", $shift['waktu_mulai'])[1];

        try {
            // cek absensi hari ini 
            $terlambat = "";
            $user = User::find(Auth::user()->id);
            if ( count($countAbsen) == 0 ) {
                $terlambat = $jam.":".$minute;   
                $user->terlambat = Auth::user()->terlambat + 1;
            }
            $user->absen = Auth::user()->absen + 1;
            $user->save();

            Absensi::create([
                "user_id" => Auth::user()->id,
                "shift_id" => $shift->id,
                "waktu" => $currentTime,
                "terlambat" => $terlambat,
                "absen" => $timeNow
            ]);
            return back()->with("success", "Berhasil Absen!");
        }catch(Exception $e) {
            return back()->with("danger", $e->getMessage());
        }

    }
}
