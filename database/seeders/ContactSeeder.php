<?php

namespace Database\Seeders;

use App\Models\contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact = new contact();
        $contact->email = "xyz@gmail.com";
        $contact->phone = "9872346778";
        $contact->fax = "2947489";
        $contact->location = "Pokhara, Nepal";
        $contact->save();
    }
}
