<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('guests')->insert([
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'contact' => '08123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
