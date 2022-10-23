<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $freeAuthorId = Author::with('books')->doesntHave('books')->inRandomOrder()->first()->id;
        return [
            'name' => 'THE ' . $this->faker->word(),
            'author_id' => $freeAuthorId,
        ];
    }
}
