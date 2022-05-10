<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => $faker->name,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }


        foreach ($data as $chunk) {
            Category::create($chunk);
        }
    }
}
