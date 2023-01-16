<x-app-layout>

    <div class="max-w-7xl bg-white shadow-2xl rounded-lg mx-auto text-center py-12 mt-10">

        @if (!blank($cinemaCompany))
            <h2 class="text-lg leading-9 font-semibold tracking-tight text-gray-800">
                There is a Cinema Company captured on the system.
            </h2>
            <div class="mt-8 flex justify-center">
                <div class="inline-flex">
                    <h1 class="text-2xl font-bold">
                        {{ $cinemaCompany->name }}
                    </h1>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                @can('edit-cinema-company')
                    <div class="inline-flex rounded-md bg-yellow-300 m-2">
                        <a href="{{ route('cinema-company.edit', $cinemaCompany) }}" class="font-semibold py-2 px-6">
                            Edit
                        </a>
                    </div>
                @endcan

                @can('delete-cinema-company')
                        <div class="">
                            <form method="POST" action="{{ route('cinema-company.destroy', $cinemaCompany) }}" class="">
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

        @else

            <h2 class="text-2xl leading-9 font-bold tracking-tight text-gray-800">
                There is no Cinema Company captured on the system. Please create one to proceed with using the system.
            </h2>

            @can('create-cinema-company')
                <div class="mt-8 flex justify-center">
                    <div class="inline-flex rounded-md bg-gray-500">
                        <a href="{{ route('cinema-company.create') }}" class="font-semibold py-2 px-6">
                            Create Cinema Company
                        </a>
                    </div>
                </div>
            @endcan


        @endif
    </div>



</x-app-layout>
