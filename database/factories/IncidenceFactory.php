<?php

namespace Database\Factories\Api;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incidence>
 */
class IncidenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>fake()->integer(),
            'area_id'=>fake()->integer(),
            'category_id'=>fake()->integer(),
            'location_id'=>fake()->integer(),
            'state_id'=>fake()->integer(),
            'title'=>fake()->name(),
            'description'=>fake()->name(),
        ];
    }
}
