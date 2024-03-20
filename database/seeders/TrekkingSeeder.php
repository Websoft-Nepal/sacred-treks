<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Trekking;

class TrekkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define an array to store generated trekking data
        $trekkings = [];

        // Generate 10 random trekking entries using Faker
        for ($i = 0; $i < 10; $i++) {
            $trekkings[] = [
                'title' => $faker->sentence(3),
                'status' => $faker->boolean(90), // 90% chance of true
                'image' => $faker->imageUrl(),
                'duration' => $faker->randomElement(['3 days', '5 days', '1 week']),
                'cost' => $faker->randomFloat(2, 100, 5000), // Random cost between 100 and 5000
                'location_id' => $faker->numberBetween(1, 3), // Assuming 5 location options
                'slug' => $faker->slug,
                'description' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Trekking::insert($trekkings);
    }
}
