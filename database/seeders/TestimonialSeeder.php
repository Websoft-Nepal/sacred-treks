<?php

namespace Database\Seeders;

use App\Models\testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\TestimonialFactory;
use Faker\Factory  as Faker;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            testimonial::create([
                'name' => $faker->name,
                'image' => $faker->imageUrl(),
                'review' => $faker->numberBetween(1, 5),
                'description' => $faker->text,
            ]);
        }
    }
}
