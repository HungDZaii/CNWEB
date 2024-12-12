<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('students')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'date_of_birth' => $faker->dateTimeBetween('-10 years', '-3 years')->format('Y-m-d'),
                'parent_phone' => $faker->phoneNumber,
                'class_id' => $faker->numberBetween(1, 2), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
