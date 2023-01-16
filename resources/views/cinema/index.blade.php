<x-app-layout>

    <div class="max-w-5xl bg-white shadow-2xl rounded-lg mx-auto text-center py-12 mt-10">

        @if (!blank($cinemas))

            <div class="relative mt-0">
                <div class="absolute left-2">
                    <h2 class="text-lg font-semibold text-gray-800 pb-4">
                        Below is the Cinema details on the system.
                    </h2>
                </div>


                <div class="absolute right-2">
                    <div class="inline-flex rounded-md bg-gray-500">
                        <a href="{{ route('cinema.create') }}" class="font-semibold py-2 px-6">
                            Create Cinema
                        </a>
                    </div>
                </div>
            </div>


            <div class="w-fit mt-12 ml-4 mr-4">
                <table class="table-auto border-collapse">
                    <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Cinema Name</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Cinema Location</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($cinemas as $cinema)
                        <tr class="bg-gray-100">
                            <td class="text-left py-3 px-4">{{ $cinema->name }}</td>
                            <td class="text-left py-3 px-4">{{ $cinema->location }}</td>
                            <td class="text-left py-3 px-4">
                                <div class="mt-4 flex justify-left">
                                    <div class="inline-flex rounded-md bg-yellow-300 m-2">
                                        <a href="{{ route('cinema.edit', $cinema) }}" class="font-semibold py-2 px-6">
                                            Edit
                                        </a>
                                    </div>

                                    <div class="">
                                        <form method="POST" action="{{ route('cinema.destroy', $cinema) }}" class="">
                                            @csrf
                                            @method('DELETE')

                                            <div class="inline-flex rounded-md bg-red-500 m-2">
                                                <input type="submit" class="font-semibold py-2 px-6 justify-center items-center cursor-pointer"
                                                       value="Delete" />
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

            <h2 class="text-2xl leading-9 font-bold tracking-tight text-gray-800">
                There is no Cinema captured on the system. Please create one to proceed with using the system.
            </h2>
            <div class="mt-8 flex justify-center">
                <div class="inline-flex rounded-md bg-gray-500">
                    <a href="{{ route('cinema.create') }}" class="font-semibold py-2 px-6">
                        Create Cinema
                    </a>
                </div>
            </div>

        @endif

    </div>

</x-app-layout>
