<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TodoList>
 */
class TodoListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->unique()->title,
            'desc' => fake()->text,
            'user_id' => 1,
            'completed' => fake()->boolean,
            'status' => fake()->randomElement(['HOLD', 'IN PROGRESS', 'COMPLETED', 'CANCELLED'])
        ];
    }
}
