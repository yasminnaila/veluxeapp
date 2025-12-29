<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert beberapa room contoh
        DB::table('rooms')->insert([
            [
                'name' => 'Deluxe Room',
                'type' => 'Deluxe',
                'price' => 500000,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Superior Room',
                'type' => 'Superior',
                'price' => 350000,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Suite Room',
                'type' => 'Suite',
                'price' => 800000,
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Tambahkan rooms acak dari Faker
        $faker = Faker::create();
        foreach (range(1, 15) as $index) {
            DB::table('rooms')->insert([
                'name' => ucfirst($faker->word()) . ' Room',
                'type' => $faker->randomElement(['Deluxe', 'Standard', 'Suite', 'Single', 'Luxury']),
                'price' => (int) $faker->randomFloat(2, 500000, 4000000),
                'status' => $faker->randomElement(['available', 'unavailable']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
