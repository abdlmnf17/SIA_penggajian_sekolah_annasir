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

    public function gajis()
    {
        return $this->hasMany(Gaji::class);
    }
    // Relasi ke Tunjangan
    public function tunjangan()
    {
        return $this->hasMany(Tunjangan::class,  'karyawan_id');
    }

    // Relasi ke Potongan
    public function potongan()
    {
        return $this->hasMany(Potongan::class,  'karyawan_id');
    }
}
