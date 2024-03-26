<?php

namespace Database\Seeders;

use App\Models\TrekkingPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrekkingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        TrekkingPage::create([
            'itinerary_quotes' => "Embark on a journey through our meticulously planned day-by-day itinerary, unveiling the exhilarating highlights and engaging activities that await you each day of your trek.",
        ]);
    }
}
