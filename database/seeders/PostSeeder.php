<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class PostSeeder extends Seeder
{
    public function run(Faker $faker)
    {

        $user = User::create(['name' => 'anil thakur', 'email' => 'anilthakur@gmail.com', 'password' => bcrypt('password')]);
        $data = [];

        for ($i = 0; $i < 1000; $i++) {
            $data[] = [
                'name' => $faker->sentence,
                'content' => $faker->paragraph,
                'subcategory_id' => $faker->numberBetween(1, 20),
                'brand_id' => $faker->numberBetween(1, 10),
                'tag_id' => $faker->numberBetween(1, 10),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
                'user_id' => $user->id
            ];
        }

        $chunks = array_chunk($data, 100);

        foreach ($chunks as $chunk) {
            Post::insert($chunk);
        }
    }
}
