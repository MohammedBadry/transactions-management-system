<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\UserGroup::Create([
            'id' => 1,
            'group_name' => 'Admin - Full Permissions',
        ]);
        \App\Models\UserGroup::Create([
            'id' => 2,
            'group_name' => 'User - Limited Permissions',
        ]);
    }
}
