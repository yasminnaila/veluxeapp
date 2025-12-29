<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil ID guest dan room yang ada di tabel
        $guestIds = DB::table('guests')->pluck('id');
        $roomIds = DB::table('rooms')->pluck('id');

        // Pastikan ada data guests dan rooms
        if ($guestIds->isEmpty() || $roomIds->isEmpty()) {
            echo "Tabel guests atau rooms kosong. Pastikan ada data pada tabel tersebut.\n";
            return;
        }

        // Tambahkan beberapa reservation contoh menggunakan guest/room pertama
        $firstGuest = $guestIds->first();
        $firstRoom = $roomIds->first();
        $secondRoom = $roomIds->slice(1, 1)->first() ?? $firstRoom;

        DB::table('reservations')->insert([
            [
                'guests_id' => $firstGuest,
                'room_id' => $firstRoom,
                'check_in' => now()->toDateString(),
                'check_out' => now()->addDays(2)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'guests_id' => $firstGuest,
                'room_id' => $secondRoom,
                'check_in' => now()->addDays(3)->toDateString(),
                'check_out' => now()->addDays(5)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Generate beberapa reservation acak
        foreach (range(1, 34) as $index) {
            $checkInDate = $faker->date('Y-m-d', 'now');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $checkInDate)->addDays(rand(1, 7))->toDateString();

            DB::table('reservations')->insert([
                'guests_id' => $faker->randomElement($guestIds),
                'room_id' => $faker->randomElement($roomIds),
                'check_in' => $checkInDate,
                'check_out' => $checkOutDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
