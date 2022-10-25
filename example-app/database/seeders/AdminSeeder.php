<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'email' => 'admin@admin.ru',
            'name' => 'Admin',
            'password' => \Hash::make('password'),
        ]);
    }
}
