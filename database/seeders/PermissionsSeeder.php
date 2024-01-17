<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\RoleHasPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::updateOrCreate([
            'name'     =>'Modulos generales',
            'code'     => 'module_general',
            'description' => 'permite acceso los modulos generales',
            'module_id' => 1
        ]);

        RoleHasPermission::updateOrCreate([
            'profile_id' => 1,
            'permission_id' => 1,
        ]);
    }
}
