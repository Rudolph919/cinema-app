<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $booking_details = Booking::where('user_id', auth()->user()->id)
            ->orderByDesc('bookings.created_at')->get();

        return view('booking.index')->with('booking_details', $booking_details);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $booking = Booking::where('id', $id)->first();

        $diff = $booking->findTimestampDiffInMinutes($id);

        if (!$diff < 60) {
            $cancelled_booking = Booking::where('id', $booking->id)->delete();

            session()->flash('flash.banner', 'Booking has been successfully deleted!');
            return redirect('booking');
        }

        session()->flash('flash.banner', 'Unable to delete/cancel booking as it is closer than 60min to the show.');
        session()->flash('flash.bannerStyle', 'danger');
        return redirect('booking');
    }
}
