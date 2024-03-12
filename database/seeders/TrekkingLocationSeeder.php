<?php

namespace Database\Seeders;

use App\Models\TrekkingLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TrekkingLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['location' => 'Annapurna Region', 'created_at' => Carbon::now()],
            ['location' => 'Everest Region', 'created_at' => Carbon::now()],
            ['location' => 'Dhaulagiri Region', 'created_at' => Carbon::now()],
        ];
        TrekkingLocation::insert($locations);
    }
}
