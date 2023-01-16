<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            UserSeeder::class,
            CinemaCompanySeeder::class,
            CinemaSeeder::class,
            TheatreSeeder::class,
            FilmSeeder::class,
            ShowTimeSeeder::class,
            ShowDateSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
