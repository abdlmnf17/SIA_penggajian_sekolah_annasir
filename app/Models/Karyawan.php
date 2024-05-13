<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_karyawan',
        'nik',
        'jabatan',
        'bidang_studi',
        'tugas_tambahan',
        'no_telepon',
        'tanggal_lahir',
        'photo',

    ];
}
