<?php

namespace Database\Seeders;

use App\Models\TourTransportation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourTransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transportations = [
            ['name' => 'Bus'],
            ['name' => 'Jeep'],
            ['name' => 'Helicopter'],
            ['name' => 'Aeroplane'],
        ];

        TourTransportation::insert($transportations);
    }
}
