<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\Cinema;
use App\Models\Film;
use App\Models\ShowDate;
use App\Models\ShowTime;
use App\Models\Theatre;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Redirector;

class BookingComponent extends Component
{
    public $cinemas;
    public $theatres;
    public $allFilms;
    public $films;
    public $showDates;
    public $showTimes;
    public $ticket_count;

    public $cinema_id = 0;
    public $theatre_id = 0;
    public $film_id = 0;
    public $showDate_id = 0;
    public $showTime_id = 0;

    public $message = '';
    public $bookingValid = false;

    public $testCinemaCompany;
    public $testCinemas;
    public $testTheatres;
    public $testFilms;
    public $testShowings;


    /**
     * @return void
     */
    public function mount(): void
    {
        $this->allFilms = Film::get();
        $this->cinemas = Cinema::get();
        $this->bookingValid = false;
    }


    public function getTheatres()
    {
        $this->theatres = Theatre::where('cinema_id', $this->cinema_id)->get();
        $this->theatre_id = 0;
        $this->film_id = 0;
        $this->showTime_id = 0;
        $this->bookingValid = false;
    }


    public function getFilms()
    {
        $this->films = Film::where('theatre_id', $this->theatre_id)->get();
        $this->showTime_id = 0;
        $this->bookingValid = false;
    }


    public function getShowDates()
    {
        $this->showDates = ShowDate::where('film_id', $this->film_id)->get();
        $this->bookingValid = false;
    }


    public function getShowTimes()
    {
        $this->showTimes = ShowTime::get();
        $this->bookingValid = false;
    }


    public function checkBookingFormValid()
    {
        if ($this->cinema_id != 0 &&
            $this->theatre_id != 0 &&
            $this->film_id != 0 &&
            $this->showDate_id != 0 &&
            $this->ticket_count > 0
        ) {
            $this->bookingValid = true;
        }

        if (!$this->bookingValid) {
            $this->addError('submitError', 'Booking not successful. All dropdowns are required. Please try again.');
            return back()->withInput();
        }
    }


    public function checkBookingExist(): bool|RedirectResponse
    {
        $record_exist = Booking::where('user_id', auth()->user()->id)
            ->where('cinema_id', $this->cinema_id)
            ->where('theatre_id', $this->theatre_id)
            ->where('film_id', $this->film_id)
            ->where('show_date_id', $this->showDate_id)
            ->get();

        if (!blank($record_exist)) {
            return false;
        }
        return true;
    }


    public function checkFilledSeatCount(): int
    {
        $filled_seats = Booking::where('theatre_id', $this->theatre_id)
            ->where('show_date_id', $this->showDate_id)
            ->get();

        return $filled_seats->count() + $this->ticket_count;
    }


    public function createBooking()
    {
        $this->checkBookingFormValid();

        if (!$this->checkBookingExist()) {
            $this->addError('submitError', 'A booking with these parameters already exists!');
            return back()->withInput();
        }

        if($this->checkFilledSeatCount() > 30)
        {
            $this->addError('submitError', 'Too many tickets selected. The maximum allowed seat count per theatre is 30 seats. The seat count with your tickets is ' . $this->checkFilledSeatCount());
            return back()->withInput();
        }

        if (!Auth::check()) {
            $this->addError('submitError', 'User not logged in. Please retry booking after logging in.');
            return redirect()->to(route('login'));
        }

        $newBooking = new Booking();
        $newBooking->user_id = auth()->user()->id;
        $newBooking->cinema_id = $this->cinema_id;
        $newBooking->theatre_id = $this->theatre_id;
        $newBooking->film_id = $this->film_id;
        $newBooking->show_date_id = $this->showDate_id;
        $newBooking->ticket_count = $this->ticket_count;
        $newBooking->reference_number = Str::upper(Str::random(9));

        try {
            $db_result = DB::transaction(function () use ($newBooking) {
                $newBooking->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            $this->addError('submitError', 'There was an error creating the Booking. Please try again. If the problem persists please contact the system admin.');
            return back()->withInput();
        }

        session()->flash('flash.banner', 'Booking has been created successfully. Reference number - ' . $newBooking->reference_number);

        return redirect()->to('booking');
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.booking-component');
    }
}
