<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * The packages that include this service.
     */
    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'package_service');
    }
}