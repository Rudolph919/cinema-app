<x-app-layout>

    <div class="max-w-7xl bg-white shadow-2xl rounded-lg mx-auto py-4 mt-10">
        <div class="p-6">
            <form method="POST" action="{{ route('cinema-company.store') }}">
                @csrf
                <div class="">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Cinema Company</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">This is the company that has the sole
                                rights on showing and distributing the films captured on this application.
                            </p>
                        </div>

                        <div class="">
                                <label for="cinema-company"
                                       class="block text-sm font-medium text-gray-700">Cinema Company</label>
                                <div class="mt-1 sm:col-span-2 sm:mt-0">
                                    <input type="text" name="cinema-company" id="cinema-company"
                                           autocomplete="cinema-company" value="{{ old('cinema-company') }}"
                                           class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">

                                    @error('cinema-company')
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
                        <button type="button" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
                        <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>

