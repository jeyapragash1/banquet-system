<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('System Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Tax Configuration</h3>
                    <form method="POST" action="{{ route('settings.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tax Type -->
                            <div>
                                <x-input-label for="tax_type" value="Tax Type" />
                                <select name="tax_type" id="tax_type" class="mt-1 block w-full border-gray-300 ... rounded-md">
                                    <option value="none" @selected(old('tax_type', $settings['tax_type'] ?? 'none') == 'none')>None</option>
                                    <option value="percentage" @selected(old('tax_type', $settings['tax_type'] ?? 'none') == 'percentage')>Percentage (%)</option>
                                    <option value="flat" @selected(old('tax_type', $settings['tax_type'] ?? 'none') == 'flat')>Flat Amount (RM)</option>
                                </select>
                            </div>
                            <!-- Tax Value -->
                            <div>
                                <x-input-label for="tax_value" value="Tax Value" />
                                <x-text-input id="tax_value" name="tax_value" type="number" step="0.01" class="mt-1 block w-full" :value="old('tax_value', $settings['tax_value'] ?? 0)" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>Save Settings</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>