<?php

namespace Database\Seeders;

use App\Models\CinemaCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CinemaCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CinemaCompany::factory(1)->create();
    }
}
