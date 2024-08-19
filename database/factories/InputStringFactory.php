<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InputString>
 */
class InputStringFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'string' => fake()->word(),
            'user_id' => User::factory()
        ];
    }

    public function withString(string $string): static
    {
        return $this->state(fn (array $attributes) => [
            'string' => $string
        ]);
    }
}
