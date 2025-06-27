<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all customers from the database, latest first
        $customers = Customer::latest()->paginate(10); // paginate is better for long lists

        // Send the data to the view
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Just show the 'create' view
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'address' => 'nullable|string',
            'alternate_contact' => 'nullable|string|max:20',
            'religion_community' => 'nullable|string|max:255',
        ]);

        // 2. Create a new customer using the validated data
        Customer::create($validated);

        // 3. Redirect back to the customer list with a success message
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        // Laravel's "Route Model Binding" automatically finds the customer by its ID.
        // We just need to pass it to the view.
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        // 1. Validate the incoming data (same rules as store)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'address' => 'nullable|string',
            'alternate_contact' => 'nullable|string|max:20',
            'religion_community' => 'nullable|string|max:255',
        ]);

        // 2. Update the customer model with the validated data
        $customer->update($validated);

        // 3. Redirect back to the customer list with a success message
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        // Delete the customer from the database
        $customer->delete();

        // Redirect back to the customer list with a success message
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
