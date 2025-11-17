<?php

namespace Database\Factories;

use App\Models\Places;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlacesFactory extends Factory
{
    protected $model = Places::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
            'slug' => $this->faker->slug,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
        ];
    }
}
