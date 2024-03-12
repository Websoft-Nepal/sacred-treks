<?php

namespace Database\Seeders;

use App\Models\TourTransportation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TourTransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transportations = [
            ['name' => 'Bus', 'created_at' => Carbon::now()],
            ['name' => 'Jeep', 'created_at' => Carbon::now()],
            ['name' => 'Helicopter', 'created_at' => Carbon::now()],
            ['name' => 'Aeroplane', 'created_at' => Carbon::now()],
        ];

        TourTransportation::insert($transportations);
    }
}
