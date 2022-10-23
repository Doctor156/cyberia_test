<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Book::factory(10)->create();
    }
}
