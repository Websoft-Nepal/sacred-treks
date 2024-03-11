<?php

namespace Database\Seeders;

use App\Models\TermsCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $terms =  new TermsCondition();
        $terms->title = "hello";
        $terms->description = "lkjakldjahfdljdfk";
        $terms->save();
    }
}
