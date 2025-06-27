<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Manage Stock for: <span class="text-indigo-500">{{ $inventoryItem->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Column 1: Add New Log -->
            <div class="md:col-span-1">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Add Stock Log</h3>
                        <p class="mb-4 text-gray-600 dark:text-gray-400">Current Stock: <span class="font-bold text-xl">{{ $inventoryItem->quantity }}</span></p>

                        @if ($errors->any())
                            <div class="mb-4">
                                <ul class="list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('stock-logs.store', $inventoryItem) }}" method="POST">
                            @csrf
                            <!-- Change Amount -->
                            <div>
                                <x-input-label for="change" :value="__('Change Amount')" />
                                <x-text-input id="change" class="block mt-1 w-full" type="number" name="change" required />
                                <p class="text-xs text-gray-500 mt-1">Use a positive number for Stock In (e.g., 10) and a negative number for Stock Out (e.g., -5).</p>
                            </div>

                            <!-- Reason -->
                            <div class="mt-4">
                                <x-input-label for="reason" :value="__('Reason (Optional)')" />
                                <x-text-input id="reason" class="block mt-1 w-full" type="text" name="reason" :value="old('reason')" />
                                <p class="text-xs text-gray-500 mt-1">e.g., New purchase, Event #123, Damaged</p>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button>
                                    {{ __('Save Log') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Column 2: Log History -->
            <div class="md:col-span-2">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                         <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Log History</h3>
                         <div class="overflow-y-auto h-96">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left ...">Date</th>
                                        <th class="px-6 py-3 text-left ...">Change</th>
                                        <th class="px-6 py-3 text-left ...">Reason</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                    @forelse($logs as $log)
                                        <tr>
                                            <td class="px-6 py-4">{{ $log->created_at->format('d M Y, H:i') }}</td>
                                            <td class="px-6 py-4">
                                                @if($log->change > 0)
                                                    <span class="font-bold text-green-500">+{{ $log->change }}</span>
                                                @else
                                                    <span class="font-bold text-red-500">{{ $log->change }}</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">{{ $log->reason }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="text-center p-4">No log history for this item.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                         </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>