<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Exception;
use Illuminate\Http\Request;

class SiftKerja extends Controller
{
    function index() {
        $shift = Shift::all();
        return view("pages.dashboard.shift.index", [
            "shift" => $shift
        ]);
    }

    function add(Request $request) {
        try {
            Shift::create($request->except("_token"));
            return back()->with("success", "Shift Kerja berhasil ditambahkan!");
        }catch(Exception $e) {
            return back()->with("danger", $e->getMessage());
        }
    }
    function remove( String $id ) {
        try {
            Shift::destroy($id);
            return back()->with("success", "Shift Kerja berhasil ditambahkan!");
        }catch(Exception $e) {
            return back()->with("danger", $e->getMessage());
        }
    }
}
