<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Event Packages') }}
            </h2>
            <a href="{{ route('packages.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 ...">
                Create Package
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left ...">Name</th>
                                <th class="px-6 py-3 text-left ...">Price</th>
                                <th class="px-6 py-3 text-left ...">Status</th>
                                <th class="relative px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($packages as $package)
                            <tr>
                                <td class="px-6 py-4">{{ $package->name }}</td>
                                <td class="px-6 py-4">RM {{ number_format($package->price, 2) }}</td>
                                <td class="px-6 py-4">
                                    @if($package->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('packages.edit', $package) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center p-4">No packages found. Create one!</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>