<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Database\Seeders\UserSeeder::class,        // admin user
            \Database\Seeders\RoomSeeder::class,        // room dummy
            \Database\Seeders\GuestSeeder::class,       // guest dummy
            \Database\Seeders\ReservationSeeder::class, // reservation dummy
        ]);
    }
}
