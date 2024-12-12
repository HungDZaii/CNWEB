<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('movies')->insert([
                'title' => $faker->sentence(3),
                'director' => $faker->name, 
                'release_date' => $faker->date('Y-m-d', 'now'), 
                'duration' => $faker->numberBetween(80, 180), 
                'cinema_id' => $faker->numberBetween(1, 10), 
                'created_at' => now(),
                'updated_at' => now(), 
            ]);
        }
    }
}
