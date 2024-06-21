<?php

namespace App\Domain\Contracts;

use App\Domain\Models\Payment;

interface CheckerRepository
{
    /**
     * @return array
     */
    public function authorize(): int;

    /**
     * @param array $filter
     * @return Payment|null
     */
    public function notifier(): int;
}
