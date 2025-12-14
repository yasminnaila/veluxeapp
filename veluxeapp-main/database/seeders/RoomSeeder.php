<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // buat 200 room kalau belum ada
        for ($i = 1; $i <= 200; $i++) {
            DB::table('rooms')->insert([
                'name' => "Room {$i}",
                'type' => $faker->randomElement(['Deluxe', 'Standard', 'Suite', 'Single', 'Luxury']),
                'price' => $faker->randomFloat(2, 300000, 5000000),
                'status' => $faker->randomElement(['available', 'unavailable']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
