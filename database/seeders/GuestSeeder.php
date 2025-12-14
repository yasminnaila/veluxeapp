<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GuestSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

       DB::table('guests')->insert([
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'contact' => $faker->phoneNumber(),   // <-- tambah ini
    'created_at' => now(),
    'updated_at' => now(),
]);

    }
}
