<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userToCreate = User::where('email', "rsaan02@gmail.com")->exists();
        if (!$userToCreate) {
            User::create([
                "email"=>"rsaan02@gmail.com",
                "name"=> "rafa",
                "password"=>bcrypt("xSaan375"),
                "username"=> "raff_boy",
                "profile_id" => 1
            ]);
        }
    }
}
