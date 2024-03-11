<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $social = new SocialMedia();
        $social->facebook = "facebook.com";
        $social->instagram = "instagram.com";
        $social->youtube = "youtube.com";
        $social->twitter = "twitter.com";
        $social->save();

    }
}
