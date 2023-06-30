<?php

namespace Database\Seeders;

use App\Models\LegalPerson;
use Illuminate\Database\Seeder;

class LegalPersonSeeder extends Seeder
{
    public function run(): void
    {
        LegalPerson::factory()->count(25)->create();
    }
}