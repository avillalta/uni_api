<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{

    public function run(): void
    {
        $role1 = Role::firstOrCreate(['name' => 'Student']);
        $role2 = Role::firstOrCreate(['name' => 'Professor']);
        $role3 = Role::firstOrCreate(['name' => 'Admin']);
    }
}
