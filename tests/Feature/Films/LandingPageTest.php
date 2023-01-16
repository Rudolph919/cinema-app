<?php

namespace Tests\Feature\Films;

use App\Http\Livewire\BookingComponent;
use App\Models\Cinema;
use App\Models\Film;
use App\Models\ShowDate;
use App\Models\Theatre;
use Database\Factories\UserFactory;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Livewire\Livewire;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_can_see_list_of_movies_and_dropdowns_to_make_a_booking_on_landing_page()
    {
        $films = Film::factory()->count(4)->create();

        $this->assertDatabaseCount('films', 4);

        $this->get(route('home'))
            ->assertSuccessful()
            ->assertSee([
                'Now Showing',
                $films[0]->name,
                $films[1]->name,
                $films[2]->name,
                $films[3]->name,
                '-- Choose a cinema --',
                '-- Choose a theatre --',
                '-- Choose a film --',
                '-- Choose a showing date --',
                '-- Choose the ticket count --',
                'Book Now',
            ]);
    }

    public function test_can_see_dynamic_dropdowns_info_updates_when_changed_to_make_a_booking()
    {
        $this->seed(DatabaseSeeder::class);

        $cinemas = Cinema::get();
        $theatres = Theatre::get();
        $films = Film::get();
        $showDates = ShowDate::get();

        $this->assertDatabaseCount('cinemas', 2);
        $this->assertDatabaseCount('theatres', 4);
        $this->assertDatabaseCount('films', 4);

        $cinema_id = 1;
        $theatre_id = 1;
        $film_id = 1;

        $this->get(route('home'))
            ->assertSuccessful();

        Livewire::test(BookingComponent::class)
            ->assertSuccessful()
            ->assertSeeInOrder([
                '-- Choose a cinema --',
                $cinemas[0]->name,
                $cinemas[1]->name,
            ])
            ->set('cinema_id', $cinema_id)
            ->call('getTheatres')
            ->assertSeeInOrder([
                '-- Choose a theatre --',
                $theatres[0]->name,
                $theatres[1]->name,
            ])
            ->set('theatre_id', 1)
            ->call('getFilms')
            ->assertSeeInOrder([
                '-- Choose a film --',
                $films[0]->name,
            ])
            ->set('film_id', 2)
            ->call('getShowDates')
            ->assertSeeInOrder([
                '-- Choose a showing date --',
                Carbon::parse($showDates[0]->showing_date)->format('Y-m-d'),
                Carbon::parse($showDates[1]->showing_date)->format('Y-m-d'),
                Carbon::parse($showDates[2]->showing_date)->format('Y-m-d'),
                Carbon::parse($showDates[3]->showing_date)->format('Y-m-d'),
            ]);
    }

    public function test_can_see_validation_errors_on_empty_fields ()
    {
        $this->seed(DatabaseSeeder::class);
        $user = (new UserFactory())->create();

        $this->actingAs($user)
            ->assertAuthenticated()
            ->get(route('home'))
            ->assertSuccessful();

        Livewire::test(BookingComponent::class)
            ->set('cinema_id', 0)
            ->set('theatre_id', 0)
            ->set('film_id', 0)
            ->set('showDate_id', 0)
            ->call('createBooking')
            ->assertSee(
                'Booking not successful. All dropdowns are required. Please try again.'
            );
    }

    public function test_can_create_booking()
    {
        $this->seed(DatabaseSeeder::class);
        $user = (new UserFactory())->create();

        $this->actingAs($user)
            ->assertAuthenticated()
            ->get(route('home'))
            ->assertSuccessful();

        $cinema_id = 1;
        $theatre_id = 1;
        $film_id = 1;
        $show_date_id = 1;
        $ticket_count = 3;

        $this->assertDatabaseCount('bookings', 4);

        Livewire::test(BookingComponent::class)
            ->set('cinema_id', $cinema_id)
            ->set('theatre_id', $theatre_id)
            ->set('film_id', $film_id)
            ->set('showDate_id', $show_date_id)
            ->set('ticket_count', $ticket_count)
            ->call('createBooking');

        $this->assertDatabaseCount('bookings', 5);
    }
}
