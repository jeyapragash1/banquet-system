<x-frontend-layout>

    <!-- Hero Section with Background Image -->
    <div class="relative bg-gray-800">
        <div class="absolute inset-0">
            <!-- IMPORTANT: Replace this with your best hero image -->
            <img class="w-full h-full object-cover" src="{{ asset('images/gallery-1.jpg') }}" alt="Elegant Banquet Hall">
            <div class="absolute inset-0 bg-gray-800 mix-blend-multiply" aria-hidden="true"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Your Perfect Event, Perfectly Planned</h1>
            <p class="mt-6 text-xl text-indigo-100 max-w-3xl">From grand weddings to intimate receptions, our elegant spaces and dedicated team are here to make your special day unforgettable.</p>
            <a href="{{ url('/booking') }}" class="mt-8 inline-block bg-indigo-500 py-3 px-8 border border-transparent rounded-md text-base font-medium text-white hover:bg-indigo-600 sm:w-auto">Book Your Date</a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-white dark:bg-gray-800 py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base font-semibold text-indigo-600 dark:text-indigo-400 tracking-wide uppercase">Our Commitment</h2>
                <p class="mt-1 text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl sm:tracking-tight lg:text-5xl">Everything You Need for a Flawless Day</p>
            </div>
            <div class="mt-12">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="pt-6">
                        <div class="flow-root bg-gray-50 dark:bg-gray-900 rounded-lg px-6 pb-8">
                            <div class="-mt-6">
                                <div><span class="inline-flex items-center justify-center p-3 bg-indigo-500 rounded-md shadow-lg"><svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9V3m-3.516 6.636a9 9 0 015.666 0m-5.666 0L6 3m-3.516 9.636a9 9 0 015.666 0m-5.666 0L6 21" /></svg></span></div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 dark:text-white tracking-tight">Elegant Spaces</h3>
                                <p class="mt-5 text-base text-gray-500 dark:text-gray-400">Beautifully designed halls adaptable to any theme, from classic romance to modern chic.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="pt-6">
                        <div class="flow-root bg-gray-50 dark:bg-gray-900 rounded-lg px-6 pb-8">
                            <div class="-mt-6">
                                <div><span class="inline-flex items-center justify-center p-3 bg-indigo-500 rounded-md shadow-lg"><svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg></span></div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 dark:text-white tracking-tight">All-Inclusive Packages</h3>
                                <p class="mt-5 text-base text-gray-500 dark:text-gray-400">From catering to decor and lighting, our packages cover every detail so you can relax and enjoy.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="pt-6">
                        <div class="flow-root bg-gray-50 dark:bg-gray-900 rounded-lg px-6 pb-8">
                            <div class="-mt-6">
                                <div><span class="inline-flex items-center justify-center p-3 bg-indigo-500 rounded-md shadow-lg"><svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg></span></div>
                                <h3 class="mt-8 text-lg font-medium text-gray-900 dark:text-white tracking-tight">Expert Staff</h3>
                                <p class="mt-5 text-base text-gray-500 dark:text-gray-400">Our experienced event planners and staff are dedicated to executing your vision flawlessly.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Gallery -->
    <div class="bg-gray-50 dark:bg-gray-900 py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Glimpses of Our Hall</h2>
            </div>
            <!-- THIS IS THE FIX: Using local images with asset() helper -->
            <div class="mt-12 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                <img class="rounded-lg object-cover h-48 w-full transform hover:scale-105 transition-transform duration-300" src="{{ asset('images/Wedding setup.jpg') }}" alt="Wedding setup">
                <img class="rounded-lg object-cover h-48 w-full transform hover:scale-105 transition-transform duration-300" src="{{ asset('images/Reception decor.jpg') }}" alt="Reception decor">
                <img class="rounded-lg object-cover h-48 w-full transform hover:scale-105 transition-transform duration-300" src="{{ asset('images/pp5.jpeg') }}" alt="Event lighting">
                <img class="rounded-lg object-cover h-48 w-full transform hover:scale-105 transition-transform duration-300" src="{{ asset('images/table setting.jpg') }}" alt="Table setting">
                <img class="rounded-lg object-cover h-48 w-full transform hover:scale-105 transition-transform duration-300" src="{{ asset('images/corporate event.jpg') }}" alt="Corporate event">
            </div>
        </div>
    </div>

    <!-- Final Call to Action -->
    <div class="bg-white dark:bg-gray-800">
        <div class="max-w-4xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                <span class="block">Ready to start planning?</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-gray-500 dark:text-gray-400">Check our availability and let's make your dream event a reality.</p>
            <a href="{{ url('/booking') }}" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 sm:w-auto">
                Book Now
            </a>
        </div>
    </div>

</x-frontend-layout>