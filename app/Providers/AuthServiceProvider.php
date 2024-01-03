<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Review;
use App\Models\Address;
use App\Models\Product;
use App\Models\Purchase;
use App\Policies\UserPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\AddressPolicy;
use App\Policies\ProductPolicy;
use App\Policies\PurchasePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Address::class => AddressPolicy::class,
        Review::class => ReviewPolicy::class,
        Product::class => ProductPolicy::class,
        User::class => UserPolicy::class,
        Purchase::class => PurchasePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
