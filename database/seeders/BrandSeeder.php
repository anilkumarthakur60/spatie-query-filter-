<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class BrandSeeder extends Seeder
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

        // $chunks = array_chunk($data, 10);

        foreach ($data as $chunk) {
            Brand::create($chunk);
        }
    }
}
