<x-frontend-layout>
    <div class="max-w-4xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
         <div class="text-center">
             <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Book Your Event</h2>
             <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">Send us your booking request, and we'll get back to you to confirm.</p>
         </div>

         <div class="mt-12 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="p-6 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg text-center">
                    <h3 class="text-2xl font-bold">Thank You!</h3>
                    <p class="mt-2">{{ session('success') }}</p>
                </div>
            @else

                <!-- Error Messages -->
                @if(session('error'))
                    <div class="p-4 mb-4 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="p-4 mb-4 bg-red-100 text-red-700 rounded-lg">
                        <p class="font-bold">Please correct the errors below:</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('frontend.booking.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Event Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <label for="event_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Preferred Event Date</label>
                                <input id="event_date" name="event_date" type="date" value="{{ old('event_date') }}" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="pax" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of Guests (Pax)</label>
                                <input id="pax" name="pax" type="number" value="{{ old('pax') }}" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label for="event_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type of Event</label>
                                <select id="event_type" name="event_type" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    <option @selected(old('event_type') == 'Wedding')>Wedding</option>
                                    <option @selected(old('event_type') == 'Reception')>Reception</option>
                                    <option @selected(old('event_type') == 'Birthday')>Birthday</option>
                                    <option @selected(old('event_type') == 'Corporate')>Corporate</option>
                                    <option @selected(old('event_type') == 'Other')>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Your Contact Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="contact_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number</o>
                                <input id="contact_number" name="contact_number" type="text" value="{{ old('contact_number') }}" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            </div>
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700">
                            Submit Booking Request
                        </button>
                    </div>
                </form>
            @endif
         </div>
    </div>
</x-frontend-layout>