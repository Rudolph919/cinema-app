<?php

namespace Database\Factories;

use App\Models\ShowDate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<ShowDate>
 */
class ShowDateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'film_id' => 1,
            'showing_date' => Carbon::today(),
            'show_time_id' => 1,
        ];
    }
}
