<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        City::factory()
        ->count(27)
        ->create()
        ->each(function($city){
            foreach(range(1,10) as $time)
                City::create([
                    'uf' => $city->uf,
                    'name' => fake()->city(),
                ]);
        });
    }
}