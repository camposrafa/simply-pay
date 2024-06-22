<?php

namespace App\Domain\Contracts;

use App\Domain\Models\Wallet;

interface WalletRepository
{
    /**
     * @param Wallet $wallet
     * @return Wallet
     */
    public function save(Wallet $wallet): Wallet;

    /**
     * @param array $filter
     * @return Wallet|null
     */
    public function getOne(array $filter): ?Wallet;
}
