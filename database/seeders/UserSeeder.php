<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::factory()->create([
            "name" => "Sergio",
            "surname" => "Corrales",
            "nick" => "sergio",
            "email" => "scorgon265@g.educaand.es"
        ]);

        User::factory(9)->create();
    }
}
