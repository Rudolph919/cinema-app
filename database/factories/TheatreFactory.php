<?php

namespace Database\Factories;

use App\Models\Theatre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Theatre>
 */
class TheatreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Theatre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cinema_id' => $this->faker->numberBetween(1,2),
            'name' => $this->faker->colorName . ' Theatre',
        ];
    }
}
