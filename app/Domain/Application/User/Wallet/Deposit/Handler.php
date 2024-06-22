<?php

namespace App\Domain\Application\User\Wallet\Deposit;

use App\Domain\Application\Jobs\Checker;
use Illuminate\Support\Str;
use App\Domain\Application\User\Wallet\Deposit\Command;
use App\Domain\Contracts\PaymentRepository;
use App\Domain\Contracts\UserRepository;
use App\Domain\Contracts\WalletRepository;
use App\Domain\Models\Payment;
use App\Domain\Models\Wallet;
use Exception;
use Illuminate\Support\Facades\DB;

class Handler
{
    /**
     * @param UserRepository $userRepository
     * @param WalletRepository $walletRepository
     * @param PaymentRepository $paymentRepository
     */
    function __construct(
        private UserRepository $userRepository,
        private WalletRepository $walletRepository,
        private PaymentRepository $paymentRepository
    ) {
    }

    public function handle(Command $command)
    {
        $user = $this->userRepository->getOne([
            'id' => $command->getUserId()
        ]);

        if (is_null($user)) {
            throw new Exception("user not found");
        }

        DB::beginTransaction();

        $payment = $this->paymentRepository->save(
            (new Payment())
                ->setUuid((string) Str::uuid())
                ->setPayeeId($user->getId())
                ->setPayerId($user->getId())
                ->setAmount($command->getBalance())
        );

        Checker::dispatch(null, $user, $payment);

        DB::commit();

        return $payment;
    }
}
