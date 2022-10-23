<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(GenreBookSeeder::class);
        $this->call(PermissionsSeeder::class);
    }
}
