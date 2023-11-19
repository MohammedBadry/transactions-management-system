<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      \App\Models\User::create([
        'id' => 1,
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'role' => 'admin',
        'group_id' => 1,
        'password' => bcrypt(123456789),
      ]);
    }
}
