<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Let's truncate our existing records and start from the scratch
        Article::truncate();

        $faker = \Faker\Factory::create();

        // And now, Let's create a few articles in our database
        for ($i = 0; $i < 50; ++$i) {
            Article::create([
                'title' => $faker->sentence(),
                'body' => $faker->paragraph(),
            ]);
        }
    }
}
