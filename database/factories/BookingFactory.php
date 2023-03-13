<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>fake()->user_id(),
            'area_id' => fake()->area_id(),
            'location_id' => fake()->location_id(),
            'state_id' => fake()->state_id(),
            'date' => fake()->date(),
            'startTime' => fake()->starTime(),
            'endTime' => fake()->endTime(),
            'numPeople' => fake()->numPeople(),
            'room' => fake()->room(),
            'description' => fake()->description(),
        ];
    }
}
