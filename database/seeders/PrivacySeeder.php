<?php

namespace Database\Seeders;

use App\Models\Privacy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $privacy = new Privacy();
        $privacy->title = "hello world";
        $privacy->description = "hello world description jdlasd lk";
        $privacy->save();
    }
}
