<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['name' => 'admin', 'email' => 'admin@gmail.com', 'phone' => '082158863345', 'id_number' => '3326132010000001', 'role' => 'admin', 'address' => 'semarang', 'password' => 'admin']);
    }
}
