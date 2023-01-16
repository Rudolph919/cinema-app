<x-app-layout>

    <div class="max-w-5xl bg-white shadow-2xl rounded-lg mx-auto py-4 mt-10">
        <div class="p-6">
            <form method="POST" action="{{ route('theatre.store') }}">
                @csrf
                <div class="">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Create Theatre</h3>
                        </div>

                        <div class="">
                                <label for="theatre_name"
                                       class="block text-sm font-medium text-gray-700">Theatre Name</label>
                                <div class="mt-1">
                                    <input type="text" name="theatre_name" id="theatre_name"
                                           autocomplete="theatre_name" value="{{ old('theatre_name') }}"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">

                                    @error('theatre_name')
                                        <span role="alert">
                                            <strong class="text-red-600">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                        <div class="">
                            <label for="theatre_cinema"
                                   class="block text-sm font-medium text-gray-700">Theatre Cinema Location</label>
                            <div class="mt-1">

                                <select name="theatre_cinema" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected>At which Cinema is the Theatre located</option>
                                    @foreach($cinemas as $cinema)
                                        <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
                                    @endforeach
                                </select>

                                @error('theatre_cinema')
                                <span role="alert">
                                            <strong class="text-red-600">{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        <button type="button"
                                onclick="location.href='{{ route('cinema.index') }}'"
                                class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
                        <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>

