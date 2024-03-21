<?php

namespace Database\Seeders;

use App\Models\testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\TestimonialFactory;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        testimonial::factory()->count(10)->create();
    }
}
