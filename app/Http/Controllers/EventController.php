<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Make sure DB is imported

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with(['customer', 'room'])->latest()->paginate(10);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $rooms = Room::all();
        return view('events.create', compact('customers', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'room_id' => 'nullable|exists:rooms,id',
            'event_type' => 'required|string|max:255',
            'event_date' => 'required|date',
            'pax' => 'required|integer|min:1',
            'agreed_amount' => 'required|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'advance_payment' => 'nullable|numeric|min:0',
            'event_taken_by' => 'required|string|max:255',
            'event_confirmed_by' => 'nullable|string|max:255',
            'stage_provider' => 'nullable|string|max:255',
            'stage_amount' => 'nullable|numeric|min:0',
        ]);

        $roomPrice = 0;
        if (!empty($validated['room_id'])) {
            $room = Room::find($validated['room_id']);
            if ($room) {
                $roomPrice = $room->price;
            }
        }
        
        $totalAgreed = $validated['agreed_amount'] + $roomPrice + ($validated['stage_amount'] ?? 0);
        
        $validated['inquiry_date'] = now();
        $validated['agreed_amount'] = $totalAgreed;
        $validated['balance_amount'] = ($totalAgreed - ($validated['discount_amount'] ?? 0) - ($validated['advance_payment'] ?? 0));

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Not currently used
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $customers = Customer::orderBy('name')->get();
        $rooms = Room::all();
        return view('events.edit', compact('event', 'customers', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'room_id' => 'nullable|exists:rooms,id',
            'event_type' => 'required|string|max:255',
            'event_date' => 'required|date',
            'pax' => 'required|integer|min:1',
            'agreed_amount' => 'required|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'advance_payment' => 'nullable|numeric|min:0',
            'event_taken_by' => 'required|string|max:255',
            'event_confirmed_by' => 'nullable|string|max:255',
            'stage_provider' => 'nullable|string|max:255',
            'stage_amount' => 'nullable|numeric|min:0',
        ]);
        
        $roomPrice = 0;
        if (!empty($validated['room_id'])) {
            $room = Room::find($validated['room_id']);
            if ($room) {
                $roomPrice = $room->price;
            }
        }

        $totalAgreed = $validated['agreed_amount'] + $roomPrice + ($validated['stage_amount'] ?? 0);
        
        $validated['agreed_amount'] = $totalAgreed;
        $validated['balance_amount'] = ($totalAgreed - ($validated['discount_amount'] ?? 0) - ($validated['advance_payment'] ?? 0));
        
        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
    
    /**
     * Show a printable invoice for the event.
     */
    public function invoice(Event $event)
    {
        $event->load('customer'); // Ensure customer data is loaded
        
        // Fetch tax settings
        $settings = DB::table('settings')->pluck('value', 'key');
        $taxType = $settings->get('tax_type', 'none');
        $taxValue = (float) $settings->get('tax_value', 0);

        // Calculate subtotal (Agreed amount before discount)
        // In our case, the agreed_amount already includes room/stage, so it's our base
        $subtotal = $event->agreed_amount;
        
        // Calculate tax
        $taxAmount = 0;
        $taxDisplay = '';
        if ($taxType == 'percentage') {
            $taxAmount = ($subtotal * $taxValue) / 100;
            $taxDisplay = $taxValue . '%';
        } elseif ($taxType == 'flat') {
            $taxAmount = $taxValue;
            $taxDisplay = 'Flat Rate';
        }

        // Calculate totals
        $grandTotal = $subtotal + $taxAmount - $event->discount_amount;
        $balanceDue = $grandTotal - $event->advance_payment;

        return view('events.invoice', compact('event', 'subtotal', 'taxAmount', 'taxDisplay', 'grandTotal', 'balanceDue'));
    }
}