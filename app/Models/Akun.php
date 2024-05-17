<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $table = 'akuns';

    protected $fillable = [
        'nama_akun',
        'jenis_akun',
        'kode_akun',
        'jumlah_akun',
    ];

    public function jurnals()
    {
        return $this->hasMany(Jurnal::class);
    }

}
