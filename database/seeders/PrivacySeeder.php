<?php

namespace Database\Seeders;

use App\Models\Privacy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PrivacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $privacy = new Privacy();
        $privacy->title = $faker->sentence;
        $paragraphs = [];

        for ($i = 0; $i < 10; $i++) {
            $text = $faker->paragraph(15); // Generate a longer paragraph
            $lines = explode(PHP_EOL, $text); // Split the paragraph into lines

            // Take the first 10 lines to simulate approximately 10 lines per paragraph
            $paragraphs[] = implode(PHP_EOL, array_slice($lines, 0, 10));
        }
        $privacy->description = implode('',$paragraphs);
        $privacy->save();
    }
}
