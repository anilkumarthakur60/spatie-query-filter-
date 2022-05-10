<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Faker\Generator;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {

        $data = [];

        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'name' => $faker->name,

                'category_id' => $faker->numberBetween(1, 10),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }


        foreach ($data as $chunk) {
            Subcategory::create($chunk);
        }
        //
    }
}
