<?php

namespace Database\Factories;

use App\Models\Bike;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

class BikeFactory extends Factory
{
    protected $model = Bike::class;

    public function definition()
    {
        return [
            'number_plate' => $this->faker->numberBetween(10000, 99999),
            'cc' => $this->faker->numberBetween(100, 1000),
            'billbook' => $this->faker->uuid,
            'status' => 'available',
            'model_year' => $this->faker->year,
            'variant_id' => Variant::inRandomOrder()->first()->id, // Fetch random variant_id
        ];
    }
}
