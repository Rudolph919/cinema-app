<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\ShowDate;
use App\Models\ShowTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ShowDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $films = Film::get();
        $showTimes = ShowTime::get();

        foreach ($films as $film) {

            $startDate = Carbon::parse($film->start_date);
            $endDate = Carbon::parse($film->end_date);

            while ($startDate->lessThan($endDate) || $startDate->eq($endDate)) {

                foreach($showTimes as $showTime) {
                    ShowDate::factory()->create([
                        'film_id' => $film->id,
                        'showing_date' => $startDate->toDateTime(),
                        'show_time_id' => $showTime->id,
                    ]);
                }

                $startDate->addDay();
            }
        }
    }
}
