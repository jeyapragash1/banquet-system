<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Role for') }}: {{ $user->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="role" value="Role" />
                            <select name="role" id="role" class="block mt-1 w-full border-gray-300 ... rounded-md">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" @selected($user->hasRole($role->name))>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('users.index') }}" class="text-gray-600 ... mr-4">Cancel</a>
                            <x-primary-button>Update Role</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>