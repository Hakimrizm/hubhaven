<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Partner;
use App\Models\Place;
use App\Policies\PartnerProfilePolicy;
use App\Policies\PlacePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Place::class => PlacePolicy::class,
        Partner::class => PartnerProfilePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
