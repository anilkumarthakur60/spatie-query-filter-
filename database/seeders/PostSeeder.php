<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $data = [];

        for ($i = 0; $i < 100000; $i++) {
            $data[] = [
                'name' => $faker->sentence,
                'content' => $faker->paragraph,
                'category_id' => $faker->numberBetween(1, 10),
                'brand_id' => $faker->numberBetween(1, 10),
                'tag_id' => $faker->numberBetween(1, 10),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }

        $chunks = array_chunk($data, 100);

        foreach ($chunks as $chunk) {
            Post::insert($chunk);
        }
    }
}