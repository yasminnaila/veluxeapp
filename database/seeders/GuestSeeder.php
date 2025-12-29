<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GuestSeeder extends Seeder
{
    /**
     * Seed the guests table with a sample and Faker-generated data.
     */
    public function run(): void
    {
        // Insert contoh guest statis
        DB::table('guests')->insert([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'contact' => '08123456789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tambahkan data faker sebagai variasi
        $faker = Faker::create();
        for ($i = 1; $i <= 20; $i++) {
            DB::table('guests')->insert([
                'name' => $faker->name(),
                'contact' => $faker->phoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
