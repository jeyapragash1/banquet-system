<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockLogController extends Controller
{
    /**
     * Display the stock log management page for a specific inventory item.
     */
    public function index(InventoryItem $inventoryItem)
    {
        // Eager load the relationship to see the item name, etc.
        $inventoryItem->load('stockLogs');

        $logs = $inventoryItem->stockLogs()->latest()->paginate(20);

        return view('stock-logs.index', [
            'inventoryItem' => $inventoryItem,
            'logs' => $logs,
        ]);
    }

    /**
     * Store a new stock log and update the item's quantity.
     */
    public function store(Request $request, InventoryItem $inventoryItem)
    {
        $validated = $request->validate([
            'change' => 'required|integer|not_in:0', // Must be a number, not zero
            'reason' => 'nullable|string|max:255',
        ]);

        // Use a database transaction to ensure data integrity.
        // If any part fails, the whole operation is rolled back.
        DB::transaction(function () use ($inventoryItem, $validated) {
            // 1. Update the inventory item's quantity
            // The `increment` method is safe against race conditions.
            $inventoryItem->increment('quantity', $validated['change']);

            // 2. Create the stock log record
            $inventoryItem->stockLogs()->create([
                'change' => $validated['change'],
                'reason' => $validated['reason'],
            ]);
        });

        return redirect()->route('stock-logs.index', $inventoryItem)->with('success', 'Stock log saved successfully.');
    }
}