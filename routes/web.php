<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Gedung;
use App\Http\Controllers\Jabatan;
use App\Http\Controllers\Karyawan;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Riwayat;
use App\Http\Controllers\SiftKerja;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(LoginController::class)->group(function() {
    Route::get('/', "index")->name("login");
    Route::post('/', "auth")->name("auth");

    Route::get("/logout", "logout")->name("logout");
});

// dashboard
Route::middleware("auth")->group(function() {
    Route::prefix("dashboard")->group(function() {
        // dashboard
        Route::controller(Dashboard::class)->group(function() {
            Route::get("/", "index")->name("dashboard");
            Route::get("/absen", "absenNow")->name("absenNow");
        });

        // karyawan
        Route::prefix("karyawan")->group(function() {
            Route::controller(Karyawan::class)->group(function() {
                Route::get("/", "index");
                Route::get("/{id}", "updateView")->name("updateKaryawanView");
                Route::get("/remove/{id}", "remove")->name("removeKaryawan");
                Route::post("/add", "add")->name("addKaryawan");
                Route::post("/update", "update")->name("updateKaryawan");
            });
        });

        // Shift
        Route::prefix("shift")->group(function() {
            Route::controller(SiftKerja::class)->group(function() {
                Route::get("/", "index");
                Route::get("/remove/{id}", "remove")->name("removeShift");
                Route::post("/add", "add")->name("addShift");
            });
        });

        // jabatan
        Route::prefix("jabatan")->group(function() {
            Route::controller(Jabatan::class)->group(function() {
                Route::get("/", "index");
                Route::post("/add", "add")->name("addJabatan");
                Route::get("/remove/{id}", "remove")->name("removeJabatan");
            });
        });
        
        // Gedung
        Route::prefix("gedung")->group(function() {
            Route::controller(Gedung::class)->group(function() {
                Route::get("/", "index");
                Route::get("/remove/{id}", "remove")->name("removeLokasi");
                Route::post("/add", "add")->name("addLokasi");
            });
        });

        // riwayat absensi
        Route::prefix("riwayat")->group(function() {
            Route::controller(Riwayat::class)->group(function() {
                Route::get("/", "index");
            });
        });
    });
});