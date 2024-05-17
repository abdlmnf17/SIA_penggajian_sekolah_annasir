<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun_debit_id',
        'gaji_id',
        'akun_kredit_id',
        'jumlah_akun_debit',
        'jumlah_akun_kredit',
        'keterangan',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }

    public function gaji()
    {
        return $this->belongsTo(Gaji::class);
    }

    public function akunDebit()
    {
        return $this->belongsTo(Akun::class, 'akun_debit_id');
    }

    public function akunKredit()
    {
        return $this->belongsTo(Akun::class, 'akun_kredit_id');
    }
}
