<?php

namespace App\Domain\Application\Payment\List;

use App\Domain\Application\Payment\List\Command;
use App\Domain\Contracts\PaymentRepository;
use Illuminate\Support\LazyCollection;

class Handler
{

    /**
     * @param PaymentRepository $paymentRepository
     */
    function __construct(
        private PaymentRepository $paymentRepository,
    ) {
    }

    /**
     * @return LazyCollection
     */
    public function handle(Command $command): LazyCollection
    {
        return $this->paymentRepository->getAll($command->getFilter());
    }
}
