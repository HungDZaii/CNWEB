<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) { 
            DB::table('renters')->insert([
                'name' => $faker->name,
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->email,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 