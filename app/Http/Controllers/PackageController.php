<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Service;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::with('services')->latest()->get();
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        $services = Service::all();
        return view('packages.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
            'services' => 'required|array', // Ensure services is an array
            'services.*' => 'exists:services,id', // Ensure each service ID exists
        ]);

        $package = Package::create($validated);
        $package->services()->sync($validated['services']);

        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        $services = Service::all();
        return view('packages.edit', compact('package', 'services'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
        ]);

        $package->update($validated);
        $package->services()->sync($validated['services']); // `sync` is perfect for many-to-many updates

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }
}