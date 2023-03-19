<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'area_id' => $this->faker->numberBetween(1, 5),
            'location_id' => $this->faker->numberBetween(1, 3),
            'state_id' => $this->faker->numberBetween(1, 3),
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'startTime' => $this->faker->time($format = 'H:i', $max = 'now'),
            'endTime' => $this->faker->time($format = 'H:i', $max = 'now'),
            'numPeople' => $this->faker->numberBetween(1, 20),
            'room' => $this->faker->name(),
            'description' => $this->faker->sentence,
            'comment'=> $this->faker->sentence,
        ];
    }
}
