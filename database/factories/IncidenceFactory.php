<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Category;
use App\Models\Incidence;
use App\Models\Location;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncidenceFactory extends Factory
{
    protected $model = Incidence::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'area_id' => Area::factory(),
            'category_id' => Category::factory(),
            'location_id' => Location::factory(),
            'state_id' => State::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }
}