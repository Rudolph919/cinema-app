<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    protected $table = "bookings";

    protected $fillable = [
        'user_id',
        'cinema_id',
        'theatre_id',
        'film_id',
        'show_date_id',
        'ticket_count',
        'reference_number'
    ];

    protected $with = [
        'bookingCinemaDetails',
        'bookingTheatreDetails',
        'bookingFilmDetails',
        'bookingDateDetails'];

    public function bookingCinemaDetails(): HasOne
    {
        return $this->hasOne(Cinema::class, 'id', 'cinema_id');
    }

    public function bookingTheatreDetails(): HasOne
    {
        return $this->hasOne(Theatre::class, 'id', 'theatre_id');
    }

    public function bookingFilmDetails(): HasOne
    {
        return $this->hasOne(Film::class, 'id', 'film_id');
    }

    public function bookingDateDetails(): HasOne
    {
        return $this->hasOne(ShowDate::class, 'id', 'show_date_id');
    }

    public function findTimestampDiffInMinutes($id): float
    {
        $booking = Booking::where('id', $id)->first();

        $show_date = Carbon::parse($booking->bookingDateDetails->showing_date)->format('Y-m-d');

        $show_time = Carbon::parse($booking->bookingDateDetails->showTimes->show_time_value)->format('H:m:s');

        $showing_time = strtotime($show_date . " " . $show_time);

        $current_timestamp = strtotime(Carbon::now()->setTimezone('Africa/Johannesburg')->toDateTimeString());

        return round(abs($current_timestamp - $showing_time) / 60, 2);
    }

}
