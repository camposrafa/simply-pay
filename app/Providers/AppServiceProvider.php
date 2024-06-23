<?php

namespace App\Providers;

use App\Domain\Contracts\AuthorizerRepository;
use App\Domain\Contracts\PaymentRepository;
use App\Domain\Contracts\UserRepository;
use App\Domain\Contracts\WalletRepository;
use App\Domain\Infra\Eloquent\PaymentRepository as EloquentPaymentRepository;
use App\Domain\Infra\Eloquent\UserRepository as EloquentUserRepository;
use App\Domain\Infra\Eloquent\WalletRepository as EloquentWalletRepository;
use App\Domain\Infra\Integration\AuthorizerRepository as IntegrationAuthorizerRepository;
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
        $this->app->bind(AuthorizerRepository::class, IntegrationAuthorizerRepository::class);
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
