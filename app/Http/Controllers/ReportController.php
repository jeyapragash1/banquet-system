<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Show the main reports page.
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Show a financial summary report.
     */
    public function financial(Request $request)
    {
        $query = Event::with('customer')->latest();

        // Optional: Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('event_date', [$request->start_date, $request->end_date]);
        }

        $events = $query->get();
        
        // Calculate totals
        $totalAgreed = $events->sum('agreed_amount');
        $totalAdvance = $events->sum('advance_payment');
        $totalBalance = $events->sum('balance_amount');

        return view('reports.financial', [
            'events' => $events,
            'totalAgreed' => $totalAgreed,
            'totalAdvance' => $totalAdvance,
            'totalBalance' => $totalBalance,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
        ]);
    }
}