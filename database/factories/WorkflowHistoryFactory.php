<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkflowHistory>
 */
class WorkflowHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'               => $this->faker->word,
            'task_id'               => $this->faker->word,
            'step_id'               => $this->faker->word,
            'process_flow_id'       => $this->faker->randomDigitNotNull,
            'status'                => $this->faker->boolean
        ];
    }
}
