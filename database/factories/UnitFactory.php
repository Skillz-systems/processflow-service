<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'id' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->word,
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
            'department_id' => Department::factory(),
        ];
    }
}