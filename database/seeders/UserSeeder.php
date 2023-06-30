<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => bcrypt(env('USER_PASSWORD')),
        ]);
    }
}