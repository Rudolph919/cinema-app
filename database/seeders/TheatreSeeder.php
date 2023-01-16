<?php

namespace Database\Seeders;

use App\Models\Theatre;
use Illuminate\Database\Seeder;

class TheatreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Theatre::factory(2)->create([
            'cinema_id' => 1
        ]);

        Theatre::factory(2)->create([
            'cinema_id' => 2
        ]);
    }
}
