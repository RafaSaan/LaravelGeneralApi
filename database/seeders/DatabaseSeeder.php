<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        Model::unguard();

        $this->call([
            UserProfilesSeeder::class,
            SuperAdminUserSeeder::class,
            ModulesSeeder::class,
            PermissionsSeeder::class
        ]);
    }
}
