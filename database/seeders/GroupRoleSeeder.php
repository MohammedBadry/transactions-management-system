<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // admin transactions and payments Role
        \App\Models\UserGroupRole::Create([
            'name' => 'transactions',
            'user_groups_id' => 1,
            'show' => 'yes',
            'add' => 'yes',
            'edit' => 'yes',
            'delete' => 'yes',
        ]);
        \App\Models\UserGroupRole::Create([
            'name' => 'payments',
            'user_groups_id' => 1,
            'show' => 'yes',
            'add' => 'yes',
            'edit' => 'yes',
            'delete' => 'yes',
        ]);

        // user transactions and payments Role
        \App\Models\UserGroupRole::Create([
            'name' => 'transactions',
            'user_groups_id' => 2,
            'show' => 'yes',
            'add' => 'no',
            'edit' => 'no',
            'delete' => 'no',
        ]);
        \App\Models\UserGroupRole::Create([
            'name' => 'payments',
            'user_groups_id' => 2,
            'show' => 'no',
            'add' => 'no',
            'edit' => 'no',
            'delete' => 'no',
        ]);
    }
}
