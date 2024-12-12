<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HardwaredevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); 

        foreach (range(1, 100) as $index) {
            DB::table('hardwaredevices')->insert([
                'device_name' => ucfirst($faker->word) . ' ' . $faker->numerify('###'), 
                'type' => $faker->randomElement(['Mouse', 'Keyboard', 'Headset', 'Monitor', 'Printer']), 
                'status' => $faker->boolean(80), 
                'center_id' => $faker->numberBetween(1, 100), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
