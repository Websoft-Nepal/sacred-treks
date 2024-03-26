<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            TourTransportationSeeder::class,
            TrekkingLocationSeeder::class,
            AboutUsSeeder::class,
            ContactSeeder::class,
            PrivacySeeder::class,
            SocialMediaSeeder::class,
            TermsConditionSeeder::class,
            UserSeeder::class,
            TourSeeder::class,
            TrekkingSeeder::class,
            TourCostIncludeSeeder::class,
            TrekkingCostIncludeSeeder::class,
            BlogSeeder::class,
            TestimonialSeeder::class,
            BlogPageSeeder::class,
            TourPageSeeder::class,
            TrekkingPageSeeder::class,
            HomePageSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
