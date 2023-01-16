<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::factory()->create([
            'first_name' => 'Rudi',
            'last_name'  => 'Scheepers-White',
            'email'      => 'white.rudi@gmail.com',
            'password'   => Hash::make('secret99'),
        ]);

        $adminUser->assignRole('Admin');

        $users = User::factory(30)->create();

        foreach($users as $user) {
            $user->assignRole('User');
        }
    }
}
