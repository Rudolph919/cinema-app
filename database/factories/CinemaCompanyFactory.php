<?php

namespace Database\Factories;

use App\Models\CinemaCompany;
use Illuminate\Database\Eloquent\Factories\Factory;
use Xylis\FakerCinema\Provider\Movie;


class CinemaCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CinemaCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new Movie($this->faker));

        return [
            'name' => $this->faker->studio,
        ];
    }
}
