<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Riwayat extends Controller
{
    function index() {
        $absen = Absensi::with("shift")->where("user_id", Auth::user()->id)->get();
        return view("pages.dashboard.riwayat.index", [
            "absen" => $absen
        ]);
    }
}
