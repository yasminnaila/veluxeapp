<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Inisialisasi Faker
        $faker = Faker::create();

        // Generate 15 room acak
        foreach (range(1, 15) as $index) {
            DB::table('rooms')->insert([
                'name' => $faker->word() . ' Room', // Nama kamar acak
                'type' => $faker->randomElement(['Deluxe', 'Standard', 'Suite', 'Single', 'Luxury']), // Tipe kamar acak
                'price' => $faker->randomFloat(2, 500000, 4000000), // Harga acak antara 500,000 dan 4,000,000
                'status' => $faker->randomElement(['available', 'unavailable']), // Status acak antara 'available' dan 'unavailable'
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
