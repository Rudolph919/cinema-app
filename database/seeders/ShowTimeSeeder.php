<?php

namespace Database\Seeders;

use App\Models\ShowTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShowTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->showTimes() as $key => $time) {
            $showTime = new ShowTime();
            $showTime->show_time_text = $key;
            $showTime->show_time_value = $time;
            $showTime->save();
        }
    }

    public function showTimes()
    {
        return [
            'Late Morning' => '10:00',
            'Early Afternoon' => '13:00',
            'Late Afternoon' => '17:00',
            'Early Evening' => '20:00',
        ];
    }
}
