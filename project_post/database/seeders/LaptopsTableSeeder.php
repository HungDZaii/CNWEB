<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LaptopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) { 
            DB::table('laptops')->insert([
                'brand' => $faker->text(50),
                'model' => $faker->text(50),
                'specifications' => $faker->text(50),
                'rental_status' => $faker->boolean(50),
                'renter_id' => $faker->randomNumber(1,100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 
