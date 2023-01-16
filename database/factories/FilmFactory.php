<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Xylis\FakerCinema\Provider\Movie;


/**
 * @extends Factory<Film>
 */
class FilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        $this->faker->addProvider(new Movie($this->faker));

        return [
            'name' => $this->faker->movie,
            'genre' => $this->faker->movieGenre,
            'overview' => $this->faker->overview,
            'runtime' => $this->faker->runtime,
            'theatre_id' => 0,
            'start_date' => Carbon::today(),
            'end_date' => Carbon::today()->addMonths(1),
        ];
    }
}
