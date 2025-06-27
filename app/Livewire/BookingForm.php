public function submitBooking()
{
    $this->validate();

    // Double-check availability before saving
    $isBooked = Event::where('event_date', $this->event_date)->exists();
    if ($isBooked) {
        $this->addError('event_date', 'Sorry, this date was booked while you were filling out the form. Please choose another.');
        return;
    }

    try {
        // Use a transaction to ensure both customer and event are created
        DB::transaction(function () {
            // --- THIS IS THE FIX ---

            // 1. Find the customer by their contact number
            $customer = Customer::where('contact_number', $this->contact_number)->first();

            // 2. If the customer does not exist, create a new one
            if (!$customer) {
                $customer = new Customer();
                $customer->contact_number = $this->contact_number;
            }

            // 3. Update the customer's name and other details
            // This ensures that even if the customer exists, their name is updated
            // with the one provided in the form.
            $customer->name = $this->name;
            // You could also update other fields here if you added them to the form, e.g.:
            // $customer->email = $this->email;
            $customer->save();

            // 4. Create the event and link it to the customer
            $customer->events()->create([
                'inquiry_date' => now(),
                'event_type' => $this->event_type,
                'event_date' => $this->event_date,
                'pax' => $this->pax,
                'event_taken_by' => 'Online Booking',
                // Financials will be zero until confirmed by admin
                'agreed_amount' => 0,
                'balance_amount' => 0,
            ]);
        });

        $this->bookingSuccessful = true;

    } catch (\Exception $e) {
        // You can log the error here if needed: Log::error($e->getMessage());
        session()->flash('error', 'Something went wrong. Please try again or contact us directly.');
    }
}