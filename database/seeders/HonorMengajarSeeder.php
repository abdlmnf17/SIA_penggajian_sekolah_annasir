<?php

namespace Database\Seeders;

use App\Models\HonorMengajar;
use Illuminate\Database\Seeder;

class HonorMengajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($jam = 1; $jam <= 24; $jam++) {
            HonorMengajar::create([
                'jam_mengajar' => $jam,
                'jumlah_mengajar' => $jam * 18000,
            ]);
        }
    }
}
