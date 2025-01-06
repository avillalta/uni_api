<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAssigmenSeeder extends Seeder
{
    public function run(): void
    {
        $studentRole = Role::findByName('Student');
        $professorRole = Role::findByName('Professor');
        $adminRole = Role::findByName('Admin');

        $viewSemesterPermission = Permission::whereName('view-Semester')->first();

        $viewCountryPermission = Permission::whereName('view-Country')->first();

    
        $allPermissions = Permission::all();


        $adminRole->syncPermissions($allPermissions);
    }
}
