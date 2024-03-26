<?php

namespace Database\Seeders;

use App\Models\TrekkingCostInclude;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TrekkingCostIncludeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $costs = [];
        for ($i = 0; $i < 10; $i++) {
            $costs[] = [
                'trekking_id' => $i+1,
                'description' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        TrekkingCostInclude::insert($costs);
    }
}
