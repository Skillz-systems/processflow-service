<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProcessFlowStep>
 */
class ProcessFlowStepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'                  => $this->faker->word,
            'step_route'            => $this->faker->word,
            'assignee_user_route'   => $this->faker->word,
            'next_user_designation' => $this->faker->randomDigitNotNull,
            'next_user_department'  => $this->faker->randomDigitNotNull,
            'next_user_unit'        => $this->faker->randomDigitNotNull,
            'process_flow_id'       => $this->faker->randomDigitNotNull,
            'next_user_location'    => $this->faker->randomDigitNotNull,
            'step_type'             => $this->faker->randomElement(['create', 'delete', 'update', 'approve_auto_assign', 'approve_manual_assign']),
            'user_type'             => $this->faker->randomElement(['user', 'supplier', 'customer', 'contractor']),
            'next_step_id'          => $this->faker->randomDigitNotNull,
            'status'                => $this->faker->boolean
        ];
    }
}
