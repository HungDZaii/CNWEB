<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LibrariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); 
        foreach (range(1, 100) as $index) { 
            DB::table('libraries')->insert([
                'name' => $faker->name,
                'address' => $faker->address,
                'contact_number' => $faker->numerify('0#########'), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 
