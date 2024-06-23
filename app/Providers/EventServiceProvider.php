<?php

namespace App\Providers;

use App\Domain\Application\Events\User\Create;
use App\Domain\Application\Observers\User\UserObserver;
use App\Domain\Application\Observers\User\Wallet\WalletObserver;
use App\Domain\Application\User\CreateWallet as CreateUserWallet;
use App\Domain\Models\User;
use App\Domain\Models\UserCommon;
use App\Domain\Models\UserShopKeeper;
use App\Domain\Models\Wallet;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Create::class => [
            CreateUserWallet::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Wallet::observe(WalletObserver::class);
        User::observe(UserObserver::class);
        UserCommon::observe(UserObserver::class);
        UserShopKeeper::observe(UserObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
