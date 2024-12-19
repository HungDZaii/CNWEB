<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('computers')->insert([
                'computer_name' => $faker->unique()->bothify('Lab#-PC##'),
                'model' => $faker->randomElement(['Dell Optiplex 7090', 'HP EliteDesk 800', 'Lenovo ThinkCentre M720']),
                'operating_system' => $faker->randomElement(['Windows 10 Pro', 'Ubuntu 20.04', 'macOS Monterey']),
                'processor' => $faker->randomElement(['Intel Core i5-11400', 'AMD Ryzen 5 5600G', 'Intel Core i7-11700']),
                'memory' => $faker->randomElement([8, 16, 32]),
                'available' => $faker->boolean(80), // 80% hoạt động
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
