<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potongan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_potongan',
        'jumlah_potongan',
    ];

    public function gajis()
    {
        return $this->belongsToMany(Gaji::class, 'detail_gaji_potongan', 'potongan_id', 'gaji_id');
    }
}
