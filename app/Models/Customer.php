<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'contact_number',
        'alternate_contact',
        'religion_community',
    ];

    /**
     * Get the events associated with the customer.
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
