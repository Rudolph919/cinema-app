@php use Illuminate\Support\Carbon;use Illuminate\Support\Str; @endphp
<div>


    <div class="max-w-6xl bg-white shadow-2xl rounded-lg mx-auto text-center py-10 mt-10 mb-10">

        <div class="text-center font-semibold text-2xl p-4">
            Now Showing
        </div>

        @if($allFilms->count())
            <div class="flex flex-col lg:flex-row p-6">

                @foreach($allFilms as $film)

                    <div class="w-full rounded overflow-hidden shadow-lg m-4 flex justify-between
                 bg-gray-100">
                        <div class="flex flex-col flex-grow px-8 py-4">
                            <h3 class="font-bold text-4xl md:text-2xl lg:text-2xl">
                                {{ $film->name }}
                            </h3>
                            <div class="flex justify-between mb-2">
                            <span class="text-sm">
                                {{ $film->genre }}
                            </span>
                                <span class="text-sm">
                                {{ $film->runtime }}
                            </span>
                                <span class="text-sm">
                                {{ Carbon::parse($film->runtime)->format('H:m') }}
                            </span>
                            </div>

                            <div class="flex-grow">
                                <p class="text-xl md:text-base lg:text-base text-gray-400 leading-snug truncate-overflow">
                                    {{ Str::limit($film->overview, 150) }}
                                    {{--                                <a href="#" id="showItem" class="block relative" wire:click="showFullOverview">--}}
                                    {{--                                    text--}}
                                    {{--                                </a>--}}
                                </p>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

            <form wire:submit.prevent="createBooking">

                <div class="flex w-full flex-col md:flex-row ml-2 md:ml-10 text-red-700 text-sm pb-2">
                    <p>** Please note that you need to be logged in submit the booking form.</p>
                </div>


                <div class="flex w-full flex-col md:flex-row">
                    <div class="flex justify-center w-full p-4">
                        <select wire:model="cinema_id"
                                wire:change="getTheatres"
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700
                    bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out
                    m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value=''>-- Choose a cinema --</option>

                            @foreach($cinemas as $cinema)
                                <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="flex justify-center w-full p-4">
                        <select wire:model="theatre_id"
                                wire:change="getFilms"
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700
                    bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out
                    m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value=''>-- Choose a theatre --</option>

                            @if(!empty($theatres))
                                @foreach($theatres as $theatre)
                                    <option value={{ $theatre->id }}>{{ $theatre->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="flex w-full flex-col md:flex-row">
                    <div class="flex justify-center w-full p-4">
                        <select wire:model="film_id"
                                wire:change="getShowDates"
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700
                    bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out
                    m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value=''>-- Choose a film --</option>

                            @if(!empty($films))
                                @foreach($films as $film)
                                    <option value="{{ $film->id }}">{{ $film->name }}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>

                    <div class="flex justify-center w-full p-4">
                        <select wire:model="showDate_id"
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700
                    bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out
                    m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value=''>-- Choose a showing date --</option>

                            @if(!empty($showDates))
                                @foreach($showDates as $showDate)
                                    <option value="{{ $showDate->id }}">
                                        {{ Carbon::parse($showDate->showing_date)->format('Y-m-d') }} @
                                        {{ $showDate->showTimes->show_time_value }}
                                    </option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                </div>

                <div class="flex w-full flex-col md:flex-row">

                    <div class="flex justify-left w-1/2 p-4">
                        <select wire:model="ticket_count"
                                {{--                            wire:change="getShowTimes"--}}
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700
                    bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out
                    m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value=''>-- Choose the ticket count --</option>

                            @for($i = 1; $i <= 50; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor

                        </select>
                    </div>
                </div>

                <hr class="text-gray-900 w-full mt-10 mb-10"/>

                @error('submitError')
                <span class="text-red-700 text-base font-semibold">{{ $message }}</span>
                @enderror

                <div class="flex justify-center mb-2 mt-2">
                    <button class="text-lg lg:text-sm font-bold py-2 px-4 rounded bg-orange-200 text-orange-700">
                        Book Now
                    </button>
                </div>

                <span>{{ $message }}</span>
            </form>

        @else
            <div class="text-center font-semibold text-2xl p-4 text-red-600">
                No films currently showing
            </div>
        @endif

    </div>

</div>
