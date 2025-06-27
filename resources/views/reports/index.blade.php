<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <h3 class="text-lg font-medium mb-4">Available Reports</h3>
                   <ul class="space-y-2">
                       <li>
                           <a href="{{ route('reports.financial') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                               Event Financial Summary
                           </a>
                       </li>
                       {{-- Add links to other reports here in the future --}}
                   </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>