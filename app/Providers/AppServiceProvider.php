<?php

namespace App\Providers;

use App\Domain\Contracts\CheckerRepository;
use App\Domain\Contracts\PaymentRepository;
use App\Domain\Contracts\UserRepository;
use App\Domain\Contracts\WalletRepository;
use App\Domain\Infra\Eloquent\PaymentRepository as EloquentPaymentRepository;
use App\Domain\Infra\Eloquent\UserRepository as EloquentUserRepository;
use App\Domain\Infra\Eloquent\WalletRepository as EloquentWalletRepository;
use App\Domain\Infra\RmFinances\CheckerRepository as RmFinancesCheckerRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(PaymentRepository::class, EloquentPaymentRepository::class);
        $this->app->bind(CheckerRepository::class, RmFinancesCheckerRepository::class);
        $this->app->bind(WalletRepository::class, EloquentWalletRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
