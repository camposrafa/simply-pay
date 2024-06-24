<?php

namespace App\Domain\Application\User;

use App\Domain\Application\Events\User\Create;
use App\Domain\Contracts\WalletRepository;
use App\Domain\Models\Wallet;

class CreateWallet
{

    function __construct(
        private WalletRepository $walletRepository
    ) {
    }

    public function handle(Create $event)
    {
        $this->walletRepository->save(
            (new Wallet())
                ->setUserId($event->getUser()->getId())
        );
    }
}
