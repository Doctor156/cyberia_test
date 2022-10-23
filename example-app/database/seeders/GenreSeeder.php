<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Genre::factory(10)->create();
    }
}
