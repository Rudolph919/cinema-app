<x-app-layout>

    <div class="max-w-5xl bg-white shadow-2xl rounded-lg mx-auto py-4 mt-10">
        <div class="p-6">
            <form method="POST" action="{{ route('show-time.store') }}">
                @csrf
                <div class="">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Create Show Time</h3>
                        </div>

                        <div class="">
                                <label for="show_time_text"
                                       class="block text-sm font-medium text-gray-700">Show Time Text</label>
                                <div class="mt-1">
                                    <input type="text" name="show_time_text" id="show_time_text"
                                           autocomplete="show_time_text" value="{{ old('show_time_text') }}"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">

                                    @error('show_time_text')
                                        <span role="alert">
                                            <strong class="text-red-600">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                        <div class="">
                            <label for="show_time_value"
                                   class="block text-sm font-medium text-gray-700">Show Time Value</label>
                            <div class="mt-1">
                                <input type="time" name="show_time_value" id="show_time_value"
                                       autocomplete="show_time_value" value="{{ old('show_time_value') }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">

                                @error('show_time_value')
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
                                onclick="location.href='{{ route('show-time.index') }}'"
                                class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
                        <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>

