<?php

namespace Database\Seeders;

use App\Domain\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $wallets = [
            new Wallet([
                'user_id' => 1,
                'balance' => 100.00,
            ]),
            new Wallet([
                'user_id' => 2,
                'balance' => 100.00,
            ]),
        ];

        foreach ($wallets as $wallet) {
            $wallet->save();
        }
    }
}
