<?php

namespace App\Domain\Contracts;

use App\Domain\Enum\Payment\Status;

interface AuthorizerRepository
{
    /**
     * @return void
     */
    public function authorize();

    /**
     * @return void
     */
    public function notifier();
}
