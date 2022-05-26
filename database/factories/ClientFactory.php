<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'country' => $this->faker->country,
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'project_id' => Project::factory()->create(),
        ];
    }
}
