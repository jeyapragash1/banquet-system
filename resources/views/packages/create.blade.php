<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Create New Package') }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @include('packages._form', ['package' => new \App\Models\Package(), 'action' => route('packages.store'), 'buttonText' => 'Create Package'])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>