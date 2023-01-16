<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'cinema_id' => 1,
            'theatre_id' => 1,
            'film_id' => 1,
            'show_date_id' => 1,
            'ticket_count' => 1,
            'reference_number' => fake()->asciify('********'),
        ];;
    }
}
