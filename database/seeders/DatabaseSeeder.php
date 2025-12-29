<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@veluxe.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Replace 'password' with a secure password
            'remember_token' => Str::random(10),
        ]);

        // Panggil GuestSeeder
        $this->call(GuestSeeder::class);
        // Panggil RoomSeeder
        $this->call(RoomSeeder::class);
        // Panggil ReservationSeeder
        $this->call(ReservationSeeder::class);
    }
}
