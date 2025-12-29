<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservations')->insert([
            [
                'guests_id' => 1,
                'room_id' => 1,
                'check_in' => now()->toDateString(),
                'check_out' => now()->addDays(2)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'guests_id' => 1,
                'room_id' => 2,
                'check_in' => now()->addDays(3)->toDateString(),
                'check_out' => now()->addDays(5)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
