<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
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
            'description' => $this->faker->text(20),
            'deadline' => $deadline,
            'status' => $this->faker->randomElement(['open', 'closed']),
            'assigned_user' => User::factory()->create(),
            'assigned_client' => Client::factory()->create()
            ];
    }
}
