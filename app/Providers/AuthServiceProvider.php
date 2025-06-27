<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate; // We no longer need this
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // The Gate::before() function has been removed to rely on explicit permissions.
    }
}