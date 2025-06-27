<!-- Display Validation Errors -->
@if ($errors->any())
    <div class="mb-4">
        <ul class="list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    // Set variables to avoid complex logic in the view
    $expenseCategory = old('category', $expense->category ?? '');
    $expenseDate = old('expense_date', $expense->expense_date ?? '');
    $expenseDescription = old('description', $expense->description ?? '');
    $expenseAmount = old('amount', $expense->amount ?? '');
@endphp

<form method="POST" action="{{ $action }}">
    @csrf
    @if(isset($expense))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Category -->
        <div>
            <x-input-label for="category" :value="__('Category')" />
            <select name="category" id="category" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                <option value="">-- Select Category --</option>
                <option value="Utilities" {{ $expenseCategory == 'Utilities' ? 'selected' : '' }}>Utilities</option>
                <option value="Cleaning" {{ $expenseCategory == 'Cleaning' ? 'selected' : '' }}>Cleaning</option>
                <option value="Maintenance" {{ $expenseCategory == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="Miscellaneous" {{ $expenseCategory == 'Miscellaneous' ? 'selected' : '' }}>Miscellaneous</option>
            </select>
        </div>

        <!-- Expense Date -->
        <div>
            <x-input-label for="expense_date" :value="__('Expense Date')" />
            <x-text-input id="expense_date" class="block mt-1 w-full" type="date" name="expense_date" value="{{ $expenseDate }}" required />
        </div>
    </div>

    <!-- Description -->
    <div class="mt-4">
        <x-input-label for="description" :value="__('Description')" />
        <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ $expenseDescription }}</textarea>
    </div>

    <!-- Amount -->
    <div class="mt-4">
        <x-input-label for="amount" :value="__('Amount (RM)')" />
        <x-text-input id="amount" class="block mt-1 w-full" type="number" step="0.01" name="amount" value="{{ $expenseAmount }}" required />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('expenses.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white mr-4">Cancel</a>
        <x-primary-button class="ms-4">
            {{ $buttonText }}
        </x-primary-button>
    </div>
</form>