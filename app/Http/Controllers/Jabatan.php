<?php

namespace App\Http\Controllers;

use App\Models\Jabatan as ModelsJabatan;
use Exception;
use Illuminate\Http\Request;

class Jabatan extends Controller
{
    function index() {
        $jabatan = ModelsJabatan::all();
        return view("pages.dashboard.jabatan.index", [
            "jabatan" => $jabatan
        ]);
    }

    function add( Request $request ) {
        try {
            ModelsJabatan::create($request->except("_token"));
            return back()->with("success", "Jabatan berhasil ditambahkan!");
        }catch(Exception $e) {
            return back()->with("danger", $e->getMessage());
        }
    }

    function remove( String $id ) {
        try {
            ModelsJabatan::destroy($id);
            return back()->with("success", "Jabatan berhasil dihapus!");
        }catch(Exception $e) {
            return back()->with("danger", $e->getMessage());
        }
    }
}
