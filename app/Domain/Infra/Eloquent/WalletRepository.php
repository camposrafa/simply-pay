<?php

namespace App\Domain\Infra\Eloquent;

use App\Domain\Contracts\WalletRepository as WalletRepositoryInterface;
use App\Domain\Models\Wallet;

class WalletRepository implements WalletRepositoryInterface
{
    /** @inheritDoc */
    public function save(Wallet $wallet): Wallet
    {
        $wallet->save();
        $wallet->refresh();

        return $wallet;
    }

    /** @inheritDoc */
    public function getOne(array $filter): ?Wallet
    {
        return Wallet::where($filter)->first();
    }
}
