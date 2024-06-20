<?php

namespace App\Domain\Infra\Eloquent;

use App\Domain\Contracts\PaymentRepository as PaymentRepositoryInterface;
use App\Domain\Models\Payment;
use Illuminate\Support\LazyCollection;

class PaymentRepository implements PaymentRepositoryInterface
{
    /** @inheritDoc */
    public function save(Payment $payment): Payment
    {
        $payment->save();
        $payment->refresh();

        return $payment;
    }

    /** @inheritDoc */
    public function getOne(array $filter): ?Payment
    {
        return Payment::where($filter)->first();
    }

    /** @inheritDoc */
    public function getAll(array $filter): ?LazyCollection
    {
        return Payment::where($filter)->lazy();
    }
}
