<?php

namespace App\Domain\Contracts;

use App\Domain\Models\Payment;
use GuzzleHttp\Psr7\Response;

interface CheckerRepository
{
    /**
     * @return array
     */
    public function authorize(): array;

    /**
     * @param array $filter
     * @return Payment|null
     */
    public function notifier(): Response;
}
