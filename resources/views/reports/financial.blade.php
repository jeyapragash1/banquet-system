<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event Financial Summary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('reports.financial') }}">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                            <div>
                                <x-input-label for="start_date" value="Start Date" />
                                <x-text-input type="date" name="start_date" id="start_date" class="w-full" :value="$startDate" />
                            </div>
                            <div>
                                <x-input-label for="end_date" value="End Date" />
                                <x-text-input type="date" name="end_date" id="end_date" class="w-full" :value="$endDate" />
                            </div>
                            <div>
                                <x-primary-button>Filter</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Report Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <table class="min-w-full divide-y divide-gray-200">
                       <thead>
                           <tr>
                               <th class="px-6 py-3 text-left ...">Event Date</th>
                               <th class="px-6 py-3 text-left ...">Customer</th>
                               <th class="px-6 py-3 text-right ...">Agreed</th>
                               <th class="px-6 py-3 text-right ...">Advance</th>
                               <th class="px-6 py-3 text-right ...">Balance Due</th>
                           </tr>
                       </thead>
                       <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                           @forelse($events as $event)
                           <tr>
                               <td class="px-6 py-4">{{ $event->event_date }}</td>
                               <td class="px-6 py-4">{{ $event->customer->name }}</td>
                               <td class="px-6 py-4 text-right">RM {{ number_format($event->agreed_amount, 2) }}</td>
                               <td class="px-6 py-4 text-right">RM {{ number_format($event->advance_payment, 2) }}</td>
                               <td class="px-6 py-4 text-right font-bold">RM {{ number_format($event->balance_amount, 2) }}</td>
                           </tr>
                           @empty
                           <tr><td colspan="5" class="text-center p-4">No events found for the selected period.</td></tr>
                           @endforelse
                       </tbody>
                       <tfoot class="bg-gray-50 dark:bg-gray-900">
                           <tr>
                               <th colspan="2" class="px-6 py-3 text-right font-bold">Totals:</th>
                               <th class="px-6 py-3 text-right font-bold">RM {{ number_format($totalAgreed, 2) }}</th>
                               <th class="px-6 py-3 text-right font-bold">RM {{ number_format($totalAdvance, 2) }}</th>
                               <th class="px-6 py-3 text-right font-bold">RM {{ number_format($totalBalance, 2) }}</th>
                           </tr>
                       </tfoot>
                   </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>