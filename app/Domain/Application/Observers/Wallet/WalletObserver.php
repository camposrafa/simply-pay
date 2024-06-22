<?php

namespace App\Domain\Application\Observers\Wallet;

use App\Domain\Application\Jobs\User\Notifier;
use App\Domain\Models\Wallet;

class WalletObserver
{

    /**
     * @param Wallet $wallet
     * @return void
     */
    public function updated(Wallet $wallet)
    {
        if ($wallet->isDirty('balance')) {
            Notifier::dispatch($wallet->getUser());
        }
    }
}
