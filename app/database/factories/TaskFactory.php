<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected  = Task::class;

    public function definition(): array
    {
        return [
            'title'       => ->faker->sentence(4),
            'description' => ->faker->optional()->paragraph(),
            'status'      => ->faker->randomElement(['pending','in_progress','completed']),
            'due_date'    => ->faker->optional()->dateTimeBetween('now', '+1 month'),
        ];
    }
}
