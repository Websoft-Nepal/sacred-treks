<?php

namespace Database\Seeders;

use App\Models\TrekkingLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrekkingLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['location' => 'Annapurna Region'],
            ['location' => 'Everest Region'],
            ['location' => 'Dhaulagiri Region'],
        ];
        TrekkingLocation::insert($locations);
    }
}
