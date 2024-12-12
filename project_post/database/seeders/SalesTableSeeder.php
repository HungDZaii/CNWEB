<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('sales')->insert([
                'medicine_id' => $faker->numberBetween(1, 50), 
                'quantity' => $faker->numberBetween(1, 10),
                'sale_date' => $faker->dateTimeBetween('-1 year', 'now'), // Ngày bán trong vòng 1 năm qua
                'customer_phone' => $faker->optional()->numerify('##########'), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
