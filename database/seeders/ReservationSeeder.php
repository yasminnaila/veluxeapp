<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $guestIds = DB::table('guests')->pluck('id')->toArray();
        $roomIds = DB::table('rooms')->pluck('id')->toArray();

        if (empty($guestIds) || empty($roomIds)) {
            $this->command->info('Guests or Rooms empty; skipping reservations seeder.');
            return;
        }

        // generate 2000 reservations spread across last 10 years
        $startDate = Carbon::now()->subYears(10);
        $endDate = Carbon::now();

        for ($i = 0; $i < 2000; $i++) {
            // random checkin between startDate..endDate
            $checkIn = Carbon::createFromTimestamp($faker->numberBetween($startDate->timestamp, $endDate->timestamp))->startOfDay();
            $nights = $faker->numberBetween(1, 10); // durasi 1-10 malam
            $checkOut = (clone $checkIn)->addDays($nights);

            DB::table('reservations')->insert([
                'guests_id' => $faker->randomElement($guestIds),
                'room_id' => $faker->randomElement($roomIds),
                'check_in' => $checkIn->toDateString(),
                'check_out' => $checkOut->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
