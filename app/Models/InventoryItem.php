<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- Import HasMany here

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'quantity',
    ];

    // Define the one-to-many relationship with StockLog
    public function stockLogs(): HasMany
    {
        return $this->hasMany(StockLog::class);
    }
}
