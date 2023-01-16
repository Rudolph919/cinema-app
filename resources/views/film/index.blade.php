@php use Illuminate\Support\Carbon; @endphp
<x-app-layout>

    <div class="max-w-5xl bg-white shadow-2xl rounded-lg mx-auto text-center py-12 mt-10">

        @if (!blank($films))

            <div class="relative mt-0">
                <div class="absolute left-2">
                    <h2 class="text-lg font-semibold text-gray-800 pb-4">
                        Below is a list of currently showing films.
                    </h2>
                </div>

                @can('create-film')
                    <div class="absolute right-2">
                        <div class="inline-flex rounded-md bg-gray-500">
                            <a href="{{ route('film.create') }}" class="font-semibold py-2 px-6">
                                Create Film
                            </a>
                        </div>
                    </div>
                @endcan

            </div>


            <div class="w-11/12 mt-12 ml-4 mr-4">
                <table class="table-auto border-collapse w-full">
                    <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Film Name</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Start Date</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">End Date</th>
                        @auth
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                        @endauth

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($films as $film)
                        <tr class="bg-gray-100">
                            <td class="text-left py-3 px-4">{{ $film->name }}</td>
                            <td class="text-left py-3 px-4">
                                {{ Carbon::parse($film->start_date)->toDateString()}}
                            </td>
                            <td class="text-left py-3 px-4">
                                {{ Carbon::parse($film->end_date)->toDateString()}}
                            </td>
                            @auth
                                <td class="text-left py-3 px-4">
                                    <div class="mt-4 flex justify-left">
                                        @can('edit-film')
                                            <div class="inline-flex rounded-md bg-yellow-300 m-2">
                                                <a href="{{ route('film.edit', $film) }}" class="font-semibold py-2 px-6">
                                                    Edit
                                                </a>
                                            </div>
                                        @endcan


                                            @can('delete-film')
                                                <div class="">
                                                    <form method="POST" action="{{ route('film.destroy', $film) }}" class="">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="inline-flex rounded-md bg-red-500 m-2">
                                                            <input type="submit" class="font-semibold py-2 px-6 justify-center items-center cursor-pointer"
                                                                   value="Delete" />
                                                        </div>
                                                    </form>
                                                </div>
                                            @endcan

                                    </div>
                                </td>
                            @endauth

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>




        @else

            <h2 class="text-2xl leading-9 font-bold tracking-tight text-gray-800">
                There is no Films captured on the system. Please create one to proceed with using the system.
            </h2>
            <div class="mt-8 flex justify-center">
                <div class="inline-flex rounded-md bg-gray-500">
                    <a href="{{ route('film.create') }}" class="font-semibold py-2 px-6">
                        Create Film
                    </a>
                </div>
            </div>

        @endif

    </div>

</x-app-layout>
