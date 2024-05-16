<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $fillable = [
        'akun_id', 'gaji_id', 'debit', 'kredit',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }

    public function gaji()
    {
        return $this->belongsTo(Gaji::class);
    }
}
