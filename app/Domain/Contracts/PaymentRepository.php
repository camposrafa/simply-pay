<?php

namespace App\Domain\Contracts;

use App\Domain\Models\Payment;
use Illuminate\Support\LazyCollection;

interface PaymentRepository
{
    /**
     * @param Payment $user
     * @return Payment
     */
    public function save(Payment $user): Payment;

    /**
     * @param array $filter
     * @return Payment|null
     */
    public function getOne(array $filter): ?Payment;

    /**
     * @param array|null $filter
     * @return LazyCollection|null
     */
    public function getAll(array $filter = null): ?LazyCollection;
}
