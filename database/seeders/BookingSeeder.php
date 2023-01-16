<?php

namespace Database\Seeders;

use Database\Factories\BookingFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new BookingFactory())->create([
            'user_id' => 1,
            'cinema_id' => 1,
            'theatre_id' => 1,
            'film_id' => 1,
            'show_date_id' => 1,
            'ticket_count' => 1,
        ]);

        (new BookingFactory())->create([
            'user_id' => 1,
            'cinema_id' => 1,
            'theatre_id' => 1,
            'film_id' => 1,
            'show_date_id' => 2,
            'ticket_count' => 1,
        ]);
        (new BookingFactory())->create([
            'user_id' => 1,
            'cinema_id' => 1,
            'theatre_id' => 1,
            'film_id' => 1,
            'show_date_id' => 3,
            'ticket_count' => 1,
        ]);
        (new BookingFactory())->create([
            'user_id' => 1,
            'cinema_id' => 1,
            'theatre_id' => 1,
            'film_id' => 1,
            'show_date_id' => 4,
            'ticket_count' => 1,
        ]);
    }
}
