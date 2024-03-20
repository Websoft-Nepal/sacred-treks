<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Tour;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
         // Generate 10 random tour entries using Faker
         for ($i = 0; $i < 10; $i++) {
            $tours[] = [
                'title' => $faker->sentence(3),
                'slug' => $faker->slug,
                'status' => $faker->boolean(70), // 70% chance of true
                'duration' => $faker->randomElement(['3 days', '5 days', '1 week']),
                'image' => $faker->imageUrl(),
                'map' => $faker->optional()->imageUrl(),
                'place' => $faker->city,
                'cost' => $faker->randomFloat(2, 100, 5000), // Random cost between 100 and 5000
                'boundary' => $faker->randomElement(['national', 'international']),
                'transportation_id' => $faker->numberBetween(1, 4), // 4 transportation options
                'description' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Tour::insert($tours);
    }
}
