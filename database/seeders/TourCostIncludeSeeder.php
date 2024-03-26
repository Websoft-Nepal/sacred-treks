<?php

namespace Database\Seeders;

use App\Models\TourCostInclude;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TourCostIncludeSeeder extends Seeder
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
                'tour_id' => $i+1,
                'description' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        TourCostInclude::insert($costs);
    }
}
