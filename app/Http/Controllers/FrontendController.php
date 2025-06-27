<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Event;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function packages()
    {
        $packages = Package::where('is_active', true)->with('services')->get();
        return view('frontend.packages', compact('packages'));
    }

    public function booking()
    {
        return view('frontend.booking');
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'event_date' => 'required|date|after_or_equal:today',
            'pax' => 'required|integer|min:1',
            'event_type' => 'required|string',
        ]);

        // Check if the date is already booked
        $isBooked = Event::where('event_date', $validated['event_date'])->exists();
        if ($isBooked) {
            return back()->withInput()->with('error', 'Sorry, this date is already booked. Please choose another.');
        }

        try {
            DB::transaction(function () use ($validated) {
                $customer = Customer::where('contact_number', $validated['contact_number'])->first();

                if (!$customer) {
                    $customer = new Customer();
                    $customer->contact_number = $validated['contact_number'];
                }
                $customer->name = $validated['name'];
                $customer->save();

                $customer->events()->create([
                    'inquiry_date' => now(),
                    'event_type' => $validated['event_type'],
                    'event_date' => $validated['event_date'],
                    'pax' => $validated['pax'],
                    'event_taken_by' => 'Online Booking',
                    'agreed_amount' => 0,
                    'balance_amount' => 0,
                ]);
            });

            return redirect()->route('frontend.booking')->with('success', 'Thank you! Your booking request has been received. We will contact you shortly.');

        } catch (\Exception $e) {
            // Log the real error for the developer to see
            // \Log::error('Booking form error: '.$e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong. Please try again or contact us directly.');
        }
    }
}