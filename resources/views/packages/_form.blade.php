@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
    </div>
@endif

<form method="POST" action="{{ $action }}">
    @csrf
    @if($package->exists)
        @method('PUT')
    @endif

    <!-- Name -->
    <div>
        <x-input-label for="name" value="Package Name" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $package->name)" required />
    </div>

    <!-- Description -->
    <div class="mt-4">
        <x-input-label for="description" value="Description" />
        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 ... rounded-md">{{ old('description', $package->description) }}</textarea>
    </div>

    <!-- Price -->
    <div class="mt-4">
        <x-input-label for="price" value="Price (RM)" />
        <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" :value="old('price', $package->price)" required />
    </div>

    <!-- Status -->
    <div class="mt-4">
         <x-input-label for="is_active" value="Status" />
         <select name="is_active" id="is_active" class="mt-1 block w-full border-gray-300 ... rounded-md">
             <option value="1" @selected(old('is_active', $package->is_active) == 1)>Active</option>
             <option value="0" @selected(old('is_active', $package->is_active) == 0)>Inactive</option>
         </select>
    </div>

    <!-- Services -->
    <div class="mt-6">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Included Services</h3>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($services as $service)
            <label class="flex items-center">
                <input type="checkbox" name="services[]" value="{{ $service->id }}"
                    @if( in_array($service->id, old('services', $package->services->pluck('id')->toArray())) ) checked @endif
                    class="rounded border-gray-300 ... focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $service->name }}</span>
            </label>
            @endforeach
        </div>
    </div>

    <div class="flex items-center justify-end mt-6">
        <a href="{{ route('packages.index') }}" class="text-gray-600 ... mr-4">Cancel</a>
        <x-primary-button>{{ $buttonText }}</x-primary-button>
    </div>
</form>