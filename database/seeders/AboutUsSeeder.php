<?php

namespace Database\Seeders;

use App\Models\aboutus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about = new aboutus();
        $about->title = "hello";
        $about->description = "hello dksafh";
        $about->save();
    }
}
