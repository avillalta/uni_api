<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $actions = [
            'view',
            'create',
            'edit',
            'delete'
        ];

        $models = [
            'User',
            'Country',
        ];

        foreach($models as $model){
            foreach($actions as $action) {
                $permissionName = "{$action}-{$model}";

                Permission::updateOrCreate(
                    ['name' => $permissionName],
                    ['name' => $permissionName]
                );
            }
        }
    }
}
