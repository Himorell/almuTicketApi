<?php

namespace Database\Factories;


use App\Models\Area;
use App\Models\User;
use App\Models\State;
use App\Models\Category;
use App\Models\Location;
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
            'user_id' => User::factory(),
            'area_id' => Area::factory(),
            'category_id' => Category::factory(),
            'location_id' => Location::factory(),
            'state_id' => State::factory(),
            'date' => fake()->date(),
            'startTime' => fake()->time(),
            'endTime' => fake()->time(),
            'numPeople' => fake()->integer(),
            'room' => fake()->name(),
            'description' => fake()->paragraph(),
        ];
    }
}
