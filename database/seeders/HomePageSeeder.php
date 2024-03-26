<?php

namespace Database\Seeders;

use App\Models\HomePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        HomePage::create([
            'heading' => "Let’s Enjoy Your Vacation with Sacred Valley Inn Trek",
            'subheading' => "Typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.",
            'headimg1' => $faker->imageUrl(),
            'headimg2' => $faker->imageUrl(),
            'bookimg' => $faker->imageUrl(),
            'gallery_title' => "Discover Nature Experiences",
            'trekking_title' => "Popular Treking Destinations",
            'trekking_slogan' => "Embark on an unforgettable journey with Timeless Elegance today!",
            'tour_title' => "Popular Tour Destinations",
            'tour_slogan' => "Dive into an extraordinary adventure with Eternal Grace today!",
            'feature_title' => "Things you can experience on your stay",
            'footer' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit.Tempore, sapiente."
        ]);
    }
}
