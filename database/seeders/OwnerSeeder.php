<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = new Owner();
        $owner->name = "Bishnu Prasad Tiwari";
        $owner->position = "CEO, Founder";
        $owner->description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus in dolorem commodi voluptas quibusdam reprehenderit cum voluptate obcaecati unde deserunt ipsum cupiditate esse, nemo animi quae error illo autem sint! Labore enim corrupti sint quae maxime, laudantium quidem delectus adipisci dicta accusamus";
        $owner->save();
    }
}
