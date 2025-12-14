<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph,
            'status' => TaskStatus::cases()[array_rand(TaskStatus::cases())]->value,
            'priority' => TaskPriority::cases()[array_rand(TaskPriority::cases())]->value,
            'due_date' => fake()->dateTimeBetween('now', '+1 month'),
            'project_id' => Project::inRandomOrder()->first()->id,
            'assigned_to' => User::inRandomOrder()->first()->id,
        ];
    }
}
