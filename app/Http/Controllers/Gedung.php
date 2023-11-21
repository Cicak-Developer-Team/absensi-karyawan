<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Exception;
use Illuminate\Http\Request;

class Gedung extends Controller
{
    function index() {
        $lokasi = Lokasi::all();
        return view("pages.dashboard.gedung.index", [
            "lokasi" => $lokasi
        ]);
    }

    function add( Request $request ) {
        try {
            Lokasi::create($request->except("_token"));
            return back()->with("success", "Data Berhasil ditambahkan!");
        }catch(Exception $e) {
            return back()->with("danger", $e->getMessage());
        }
    }

    function remove(String $id) {
        try {
            Lokasi::destroy($id);
            return back()->with("success", "Data Berhasil dihapus!");
        }catch(Exception $e) {
            return back()->with("danger", $e->getMessage());
        }
    }
}
