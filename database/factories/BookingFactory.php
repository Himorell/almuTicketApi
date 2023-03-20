<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\User;
use App\Models\State;
use App\Models\Booking;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'area_id' => Area::factory()->create()->id,
            'location_id' => Location::factory()->create()->id,
            'state_id' => State::factory()->create()->id,
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'startTime' => $this->faker->time($format = 'H:i', $max = 'now'),
            'endTime' => $this->faker->time($format = 'H:i', $max = 'now'),
            'numPeople' => $this->faker->numberBetween(1, 20),
            'room' => $this->faker->name(),
            'description' => $this->faker->sentence,
            'comment' => $this->faker->sentence,
        ];
    }
}
