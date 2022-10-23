<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Author::factory(10)->create();
    }
}
