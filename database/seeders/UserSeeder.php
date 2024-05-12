<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Tambahkan use statement untuk DB

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Memasukkan data pengguna manual
        User ::create([
            'name' => 'administrator',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            // 'status' => 'aktif',
            // 'last_login' => now(),
            'password' => Hash::make('admin')
        ]);

        // Memasukkan data pengguna menggunakan factory
        // User::factory()->count(10)->create();
    }
}