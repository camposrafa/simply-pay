<?php

namespace App\Domain\Application\User\Wallet\Show;

use App\Domain\Application\User\Wallet\Show\Command;
use App\Domain\Contracts\WalletRepository;
use App\Domain\Models\Wallet;

class Handler
{

    /**
     * @param WalletRepository $walletRepository
     */
    function __construct(
        private WalletRepository $walletRepository,
    ) {
    }

    /**
     * @param Command $command
     * @return Wallet
     */
    public function handle(Command $command): Wallet
    {
        return $this->walletRepository->getOne($command->getFilter());
    }
}
