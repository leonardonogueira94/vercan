<?php

namespace Database\Seeders;

use App\Models\NaturalPerson;
use Illuminate\Database\Seeder;

class NaturalPersonSeeder extends Seeder
{
    public function run(): void
    {
        NaturalPerson::factory()->count(25)->create();
    }
}