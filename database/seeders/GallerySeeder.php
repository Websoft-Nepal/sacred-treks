<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach(range(1,10) as $index){
            Gallery::create([
                'image' => $faker->imageUrl(),
                'category' => $faker->randomElement(['Boating', 'Camping', 'Cannoying']),
            ]);
        }
    }
}
