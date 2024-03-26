<?php

namespace Database\Seeders;

use App\Models\BlogPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogPage::create([
            'title' => "Voyage Chronicles: Your Guide to the Globe",
            'subtitle' => "Lorem ipsum dolor, sit amet consectetur adipisicing elit.Tempora magni tenetur enim assumenda fugiat, porro veroexplicabo cupiditate ratione aliquam doloremque quidem corporisquis nihil illum molestias commodi sapiente possimus aliquid voluptate blanditiis magnam numquam. Odit autem, officiis libero"
        ]);
    }
}
