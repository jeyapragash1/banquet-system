<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add a New Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('events.store') }}">
                        @csrf
                        
                        <!-- Customer Dropdown -->
                        <div class="mt-4">
                            <x-input-label for="customer_id" :value="__('Customer')" />
                            <select name="customer_id" id="customer_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">-- Select a Customer --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                                        {{ $customer->name }} - {{ $customer->contact_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Room Selection -->
                        <div class="mt-4">
                            <x-input-label for="room_id" :value="__('Assign a Room (Optional)')" />
                            <select name="room_id" id="room_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">-- No Room --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" @selected(old('room_id') == $room->id)>
                                        {{ $room->name }} - RM{{ number_format($room->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Note: The system does not yet prevent double-booking rooms. Please check dates manually.</p>
                        </div>

                        <!-- Event Details -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div>
                                <x-input-label for="event_type" :value="__('Event Type')" />
                                <x-text-input id="event_type" class="block mt-1 w-full" type="text" name="event_type" :value="old('event_type')" required />
                            </div>
                            <div>
                                <x-input-label for="event_date" :value="__('Event Date')" />
                                <x-text-input id="event_date" class="block mt-1 w-full" type="date" name="event_date" :value="old('event_date')" required />
                            </div>
                            <div>
                                <x-input-label for="pax" :value="__('Number of Pax')" />
                                <x-text-input id="pax" class="block mt-1 w-full" type="number" name="pax" :value="old('pax')" required />
                            </div>
                        </div>

                        <!-- Financial Details -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div>
                                <x-input-label for="agreed_amount" :value="__('Agreed Amount')" />
                                <x-text-input id="agreed_amount" class="block mt-1 w-full" type="number" step="0.01" name="agreed_amount" :value="old('agreed_amount')" required />
                            </div>
                            <div>
                                <x-input-label for="discount_amount" :value="__('Discount (Optional)')" />
                                <x-text-input id="discount_amount" class="block mt-1 w-full" type="number" step="0.01" name="discount_amount" :value="old('discount_amount', 0)" />
                            </div>
                            <div>
                                <x-input-label for="advance_payment" :value="__('Advance Payment')" />
                                <x-text-input id="advance_payment" class="block mt-1 w-full" type="number" step="0.01" name="advance_payment" :value="old('advance_payment', 0)" />
                            </div>
                        </div>

                        <!-- Stage/Throne Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-input-label for="stage_provider" :value="__('Stage/Throne Provided By')" />
                                <select name="stage_provider" id="stage_provider" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="Customer" @selected(old('stage_provider') == 'Customer')>Provided by Customer</option>
                                    <option value="Pearl" @selected(old('stage_provider') == 'Pearl')>Provided by Pearl</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="stage_amount" :value="__('Amount for Stage/Throne')" />
                                <x-text-input id="stage_amount" class="block mt-1 w-full" type="number" step="0.01" name="stage_amount" :value="old('stage_amount', 0)" />
                                <p class="text-xs text-gray-500 mt-1">Only enter an amount if "Provided by Pearl" is selected.</p>
                            </div>
                        </div>

                        <!-- Staff Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-input-label for="event_taken_by" :value="__('Event Taken By (Staff Name)')" />
                                <x-text-input id="event_taken_by" class="block mt-1 w-full" type="text" name="event_taken_by" :value="old('event_taken_by', auth()->user()->name)" required />
                            </div>
                            <div>
                                <x-input-label for="event_confirmed_by" :value="__('Event Confirmed By (Staff Name)')" />
                                <x-text-input id="event_confirmed_by" class="block mt-1 w-full" type="text" name="event_confirmed_by" :value="old('event_confirmed_by')" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button class="ms-4">
                                {{ __('Save Event') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
