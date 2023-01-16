@php use Illuminate\Support\Carbon; @endphp
<x-app-layout>

    <div class="max-w-5xl bg-white shadow-2xl rounded-lg mx-auto text-center py-10 mt-10 mb-10">

        <div class="relative mt-0">
            <div class="absolute left-2">
                <h2 class="text-2xl font-semibold text-gray-800 pb-4">
                    User Bookings
                </h2>
            </div>


            <div class="absolute right-2">
                <div class="inline-flex rounded-md bg-gray-500">
                    <a href="{{ route('home') }}" class="text-decoration-none text-black-50 font-semibold py-2 px-6">
                        Create New Booking
                    </a>
                </div>
            </div>
        </div>


        @if(!blank($booking_details))

            <div class="w-fit mt-12 ml-4 mr-4">
                <table class="table-auto border-collapse">
                    <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Movie Name</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Ticket Count</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Reference Number</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Show Date</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Show Time</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Theatre Name</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Cinema Name</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($booking_details as $show_details)
                        <tr class="bg-gray-100">
                            <td class="text-left py-3 px-4">{{ $show_details->bookingFilmDetails->name }}</td>
                            <td class="text-left py-3 px-4">{{ $show_details->ticket_count }}</td>
                            <td class="text-left py-3 px-4">{{ $show_details->reference_number }}</td>
                            <td class="text-left py-3 px-4">
                                {{ Carbon::parse($show_details->bookingDateDetails->showing_date)->format('Y-m-d') }}
                            </td>
                            <td class="text-left py-3 px-4">
                                {{ $show_details->bookingDateDetails->showTimes->show_time_value }}
                            </td>
                            <td class="text-left py-3 px-4">{{ $show_details->bookingTheatreDetails->name }}</td>
                            <td class="text-left py-3 px-4">{{ $show_details->bookingCinemaDetails->name }}</td>
                            <td class="text-left py-3 px-4">
                                <div class="mt-4 flex justify-left">
                                    <div class="">
                                        <form method="POST" action="{{ route('booking.destroy', $show_details) }}">
                                            @csrf
                                            @method('DELETE')

                                            <div class="inline-flex rounded-md bg-red-500 m-2">
                                                <input type="submit" class="font-semibold py-2 px-6 justify-center items-center cursor-pointer"
                                                       value="Cancel Booking" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        @else

            <div class="text-center font-semibold text-2xl p-4 text-red-600 mt-12 ml-4 mr-4">
                There are no bookings for this user on the system. Please try again and if the problem persists
                please contact the system admin.
            </div>

        @endif

    </div>
</x-app-layout>
