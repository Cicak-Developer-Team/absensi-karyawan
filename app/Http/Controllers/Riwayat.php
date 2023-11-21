<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Riwayat extends Controller
{
    function index() {
        if ( Auth::user()->is_karyawan !== null ) {
            $absen = Absensi::with("shift")->where("user_id", Auth::user()->id)->get();
        }else {
            $absen = Absensi::with("shift")->get();
        }
        return view("pages.dashboard.riwayat.index", [
            "absen" => $absen
        ]);
    }
}
