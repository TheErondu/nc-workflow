<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::truncate();
$faker = \Faker\Factory::create();
for ($i = 0; $i < 50; $i++) {
    Book::create([
        'title' => $faker->sentence,
        'author' => $faker->name,
    ]);
}
    }
}
