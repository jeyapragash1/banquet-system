<div>
    @if ($bookingSuccessful)
        <div class="p-6 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg text-center">
            <h3 class="text-2xl font-bold">Thank You!</h3>
            <p class="mt-2">Your booking request has been received. We will contact you shortly to confirm the details and proceed with the payment.</p>
        </div>
    @else
        @if(session()->has('error'))
            <div class="p-4 mb-4 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
        @endif

        <form wire:submit.prevent="submitBooking" class="space-y-6">
            
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">1. Select Your Date</h3>
            <div>
                <label for="event_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Date</label>
                <input wire:model.lazy="event_date" id="event_date" type="date" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                
                <!-- Loading state indicator -->
                <div wire:loading wire:target="event_date" class="text-sm text-gray-500 mt-2">Checking availability...</div>

                <!-- Availability Message -->
                @if($isDateAvailable === true)
                    <p class="mt-2 text-sm text-green-600">This date is available!</p>
                @elseif($isDateAvailable === false)
                     <p class="mt-2 text-sm text-red-600">This date is not available.</p>
                @endif
                @error('event_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            
            @if($isDateAvailable)
                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">2. Event Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                         <div>
                            <label for="event_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type of Event</label>
                            <select wire:model="event_type" id="event_type" class="mt-1 block w-full border-gray-300 ... rounded-md">
                                <option>Wedding</option>
                                <option>Reception</option>
                                <option>Birthday</option>
                                <option>Corporate</option>
                                <option>Other</option>
                            </select>
                            @error('event_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="pax" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of Guests (Pax)</label>
                            <input wire:model="pax" id="pax" type="number" class="mt-1 block w-full border-gray-300 ... rounded-md">
                            @error('pax') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">3. Your Contact Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                            <input wire:model="name" id="name" type="text" class="mt-1 block w-full border-gray-300 ... rounded-md">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="contact_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number</label>
                            <input wire:model="contact_number" id="contact_number" type="text" class="mt-1 block w-full border-gray-300 ... rounded-md">
                            @error('contact_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                         <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                            <input wire:model="email" id="email" type="email" class="mt-1 block w-full border-gray-300 ... rounded-md">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700">
                        <span wire:loading.remove>Submit Booking Request</span>
                        <span wire:loading>Submitting...</span>
                    </button>
                </div>
            @endif
        </form>
    @endif
</div>