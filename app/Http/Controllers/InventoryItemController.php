<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function index()
    {
        $inventoryItems = InventoryItem::orderBy('category')->orderBy('name')->get();
        return view('inventory-items.index', compact('inventoryItems'));
    }

    public function create()
    {
        return view('inventory-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        InventoryItem::create($validated);
        return redirect()->route('inventory-items.index')->with('success', 'Item created successfully.');
    }

    public function edit(InventoryItem $inventoryItem)
    {
        return view('inventory-items.edit', compact('inventoryItem'));
    }

    public function update(Request $request, InventoryItem $inventoryItem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        $inventoryItem->update($validated);
        return redirect()->route('inventory-items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(InventoryItem $inventoryItem)
    {
        // In a real system, you might prevent deletion if stock logs exist
        $inventoryItem->delete();
        return redirect()->route('inventory-items.index')->with('success', 'Item deleted successfully.');
    }
}