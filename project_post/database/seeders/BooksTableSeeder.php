<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); 
        foreach (range(1, 100) as $index) { 
            DB::table('books')->insert([
                'title' => $faker -> title(50),
                'author' => $faker -> name,
                'publication_year'=> $faker -> date,
                'genre' => $faker -> text(10),
                 'library_id'=> $faker->randomNumber(1,100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 