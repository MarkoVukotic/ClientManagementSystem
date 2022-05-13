<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $starts_at = date(now());
        $deadline = Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addDays(15)->toArray()['formatted'];

        return [
            'title' => $this->faker->title,
            'status' => $this->faker->randomElement(['todo', 'in_progress', 'done']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'deadline' => $deadline,
            'project_id' => Project::factory()->create(),
            'assignee' => User::factory()->create(),
        ];
    }
}
