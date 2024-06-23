<?php

namespace App\Domain\Application\Payment\Create;

use App\Domain\Application\Exceptions\ModelNotFoundException;
use App\Domain\Application\Exceptions\NotAcceptableException;
use App\Domain\Application\Jobs\Checker;
use App\Domain\Contracts\UserRepository;
use Illuminate\Support\Str;
use App\Domain\Application\Payment\Create\Command;
use App\Domain\Contracts\PaymentRepository;
use App\Domain\Models\Payment;
use Illuminate\Support\Facades\DB;

class Handler
{
    /**
     * @param UserRepository $userRepository
     */
    function __construct(
        private UserRepository $userRepository,
        private PaymentRepository $paymentRepository
    ) {
    }

    public function handle(Command $command)
    {
        $payee = $this->userRepository->getOne([
            'id' => $command->getPayeeId()
        ]);

        if (is_null($payee)) {
            throw new ModelNotFoundException(trans("Payee not found"));
        }

        if ($command->getAmount() > $command->getPayer()->getWallet()->getBalance()) {
            throw new NotAcceptableException("insufficient funds");
        }

        DB::beginTransaction();

        $payment = $this->paymentRepository->save(
            (new Payment())
                ->setUuid((string) Str::uuid())
                ->setPayeeId($command->getPayeeId())
                ->setPayerId($command->getPayer()->getId())
                ->setAmount($command->getAmount())
        );

        Checker::dispatch($command->getPayer(), $payee, $payment);

        DB::commit();

        return $payment;
    }
}
