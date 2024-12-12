<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CinemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('cinemas')->insert([
                'name' => $faker->company . ' Cinema',
                'location' => $faker->address, 
                'total_seats' => $faker->numberBetween(1, 100), 
                'created_at' => now(),
                'updated_at' => now(), 
            ]);
        }
    }
}
