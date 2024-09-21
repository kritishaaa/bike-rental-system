<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        $brands = [
            [
                'brand_name' => 'Trek',
                'brand_logo' => 'images/logos/trek.png',
            ],
            [
                'brand_name' => 'Specialized',
                'brand_logo' => 'images/logos/specialized.png',
            ],
            [
                'brand_name' => 'Giant',
                'brand_logo' => 'images/logos/giant.png',
            ],
            [
                'brand_name' => 'Cannondale',
                'brand_logo' => 'images/logos/cannondale.png',
            ],
            [
                'brand_name' => 'Bianchi',
                'brand_logo' => 'images/logos/bianchi.png',
            ],
        ];

        return $this->faker->randomElement($brands);
    }
}
