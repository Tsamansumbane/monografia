<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar userr
        User::create([
            'name' => 'Tsaman',
            'email' => 'tsaman@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
