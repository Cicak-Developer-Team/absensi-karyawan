<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama",
        "alamat",
        "jabatan_id",
        "shift_id",
        "lokasi_id",
    ];

    function jabatan() {
        return $this->hasOne(Jabatan::class, "id", "jabatan_id");
    }

    function user() {
        return $this->hasOne(User::class, "karyawan_id", "id");
    }

    function shift() {
        return $this->hasOne(Shift::class, "id", "shift_id");
    }

    function lokasi() {
        return $this->hasOne(Lokasi::class, "id", "lokasi_id");
    }
}
