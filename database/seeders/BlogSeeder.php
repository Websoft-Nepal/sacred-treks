<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define an array to store generated blog data
        $blogs = [];

        // Generate 10 random blog entries using Faker
        for ($i = 0; $i < 10; $i++) {
            $blogs[] = [
                'title' => $faker->sentence(5),
                'slug' => $faker->slug,
                'image' => $faker->imageUrl(),
                'status' => $faker->boolean(90), // 90% chance of true
                'description' => $faker->paragraphs(3, true), // Generate 3 paragraphs of text
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Blog::insert($blogs);
    }
}
