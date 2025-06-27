<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'room_id', // <-- Make sure this is here
        'inquiry_date',
        'event_type',
        'event_date',
        'pax',
        'sawan',
        'agreed_amount',
        'discount_amount',
        'advance_payment',
        'balance_amount',
        'stage_provider',
        'stage_amount',
        'receipt_number',
        'event_taken_by',
        'event_confirmed_by',
    ];

    /**
     * Define the relationship: An Event belongs to a Customer.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    
    /**
     * Define the relationship: An Event belongs to a Room.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}