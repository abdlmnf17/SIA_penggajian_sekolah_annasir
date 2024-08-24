<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id', 'honor_mengajar_id', 'kode_gaji',
        'tanggal_gaji', 'jumlah_absen', 'total_absen', 'total_gaji',
    ];

    // public function tunjangan()
    // {
    //     return $this->belongsToMany(Tunjangan::class, 'detail_gaji_tunjangan', 'gaji_id', 'tunjangan_id', 'karyawan_id');
    // }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    // public function potongan()
    // {
    //     return $this->belongsToMany(Potongan::class, 'detail_gaji_potongan', 'gaji_id', 'potongan_id', 'karyawan_id');
    // }

    public function honorMengajar()
    {
        return $this->belongsTo(HonorMengajar::class);
    }

    public function jurnals()
    {
        return $this->hasMany(Jurnal::class);
    }
}
