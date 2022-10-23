<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        $freeAuthorId = Author::with('books')->doesntHave('books')->inRandomOrder()->first()->id;
        return [
            'name' => 'THE ' . $this->faker->word(),
            'author_id' => $freeAuthorId,
        ];
    }
}
