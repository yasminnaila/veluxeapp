<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        // Inisialisasi Faker
        $faker = Faker::create();
        // Ambil ID guest dan room yang ada di tabel
        $guestIds = DB::table('guests')->pluck('id');
        $roomIds = DB::table('rooms')->pluck('id');
        // Memastikan data di tabel guests dan rooms
        if ($guestIds->isEmpty() || $roomIds->isEmpty()) {
            echo "Tabel guests atau rooms kosong. Pastikan ada data pada tabel tersebut.\n";
            return;
        }
        // Generate 34 reservation acak
        foreach (range(1, 34) as $index) {
            $checkInDate = $faker->date($format = 'Y-m-d', $max = 'now');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $checkInDate)->addDays(rand(1, 7))->toDateString(); // Check-out setelah 1-7 hari

            DB::table('reservations')->insert([
                'guests_id' => $faker->randomElement($guestIds), // ID guest acak
                'room_id' => $faker->randomElement($roomIds), // ID room acak
                'check_in' => $checkInDate, // Tanggal check-in acak
                'check_out' => $checkOutDate, // Tanggal check-out acak
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
