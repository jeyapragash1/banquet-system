<x-frontend-layout>
    <div class="bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white text-center">Our Event Packages</h2>
            <p class="mt-4 text-lg text-gray-500 dark:text-gray-400 text-center">Choose the perfect package for your special day.</p>

            <div class="mt-12 space-y-10 sm:space-y-0 sm:grid sm:grid-cols-1 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-3 lg:gap-x-8">
                @forelse($packages as $package)
                    <div class="p-8 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm flex flex-col">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $package->name }}</h3>
                        <p class="mt-4 text-gray-500 dark:text-gray-400">{{ $package->description }}</p>

                        <div class="mt-6">
                            <p class="text-5xl font-extrabold text-gray-900 dark:text-white">RM{{ number_format($package->price, 0) }}</p>
                        </div>

                        <!-- Included Features -->
                        <ul class="mt-6 space-y-4 flex-1">
                            @foreach($package->services as $service)
                            <li class="flex space-x-3">
                                <!-- Heroicon: check -->
                                <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $service->name }}</span>
                            </li>
                            @endforeach
                        </ul>

                        <a href="{{ url('/booking') }}" class="mt-8 block w-full bg-indigo-600 border border-transparent rounded-md py-3 text-sm font-semibold text-white text-center hover:bg-indigo-700">
                            Book {{ $package->name }}
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                        <p>There are currently no active packages available. Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-frontend-layout>