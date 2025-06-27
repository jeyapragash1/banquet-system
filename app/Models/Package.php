<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_active',
    ];

    /**
     * The services that belong to the package.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'package_service');
    }
}