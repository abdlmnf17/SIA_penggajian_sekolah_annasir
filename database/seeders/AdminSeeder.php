<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name'	=> 'Admin',  //Nama Admin
            'email'	=> 'admin@gmail.com',
            'role' => 'admin', //Untuk seeder diwajibkan role Admin
            'password'	=> Hash::make('password'), //Masukan password admin, ubah kata password dengan kata yg lain
            'created_at' => now(),
            'updated_at' => now(),

        ]);

    }
}
