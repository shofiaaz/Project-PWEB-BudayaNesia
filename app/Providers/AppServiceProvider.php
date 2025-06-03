<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event; // Import Facade Event
use App\Events\ContentApproved; // Import Event Anda
use App\Listeners\ContentApprovedListener; // Import Listener Anda

class AppServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<class-string>>
     */
    protected $listen = [
        ContentApproved::class => [
            ContentApprovedListener::class,
        ],

    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

    }
}
