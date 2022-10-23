<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    public function definition(): array
    {
        $users = User::all()->pluck('id')->toArray();
        return [
            'name' => $this->faker->name(),
            'user_id' => $this->faker->unique()->randomElement($users),
        ];
    }
}
