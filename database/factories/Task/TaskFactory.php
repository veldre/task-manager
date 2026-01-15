<?php

namespace Database\Factories\Task;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'due_at' => $this->faker->optional()->date(),
        ];
    }
}
