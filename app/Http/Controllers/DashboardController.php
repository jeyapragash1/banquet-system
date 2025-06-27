<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Expense;
use App\Models\InventoryItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Financial Stats ---
        $monthlyRevenue = Event::whereYear('event_date', date('Y'))
                            ->whereMonth('event_date', date('m'))
                            ->sum('agreed_amount');

        $monthlyExpenses = Expense::whereYear('expense_date', date('Y'))
                                ->whereMonth('expense_date', date('m'))
                                ->sum('amount');

        // --- Event Stats ---
        $totalBookings = Event::count();
        $upcomingEvents = Event::where('event_date', '>=', Carbon::today())->count();


        // --- Inventory Stats ---
        $lowStockItems = InventoryItem::where('quantity', '<', 10)->count();


        // Pass all the data to the view
        return view('dashboard', [
            'totalBookings' => $totalBookings,
            'upcomingEvents' => $upcomingEvents,
            'monthlyRevenue' => $monthlyRevenue,
            'lowStockItems' => $lowStockItems,
            'monthlyExpenses' => $monthlyExpenses,
        ]);
    }
}