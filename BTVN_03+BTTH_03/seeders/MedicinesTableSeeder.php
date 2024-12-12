<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('medicines')->insert([
                'name' => $faker->word,
                'brand' => $faker->company,
                'dosage' => $faker->randomElement(['10mg', '500mg', '1000mg']),
                'form' => $faker->randomElement(['tablet', 'capsule', 'syrup']),
                'price' => $faker->randomFloat(2, 1, 100), 
                'stock' => $faker->numberBetween(10, 1000), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
