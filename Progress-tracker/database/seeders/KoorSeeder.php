<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KoorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $koorData = [
            'name' => 'koor',
            'email' => 'admin@gmail.com',
            'role' => 'koor',
            'password' => bcrypt('password'),
        ];
        User::updateOrCreate(['email' => $koorData['email']], $koorData);
    }
}
