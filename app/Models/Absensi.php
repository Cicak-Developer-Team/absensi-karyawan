<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "shift_id",
        "waktu",
        "absen",
        "terlambat"
    ];

    function shift() {
        return $this->hasOne(Shift::class, "id", "shift_id");
    }
}
