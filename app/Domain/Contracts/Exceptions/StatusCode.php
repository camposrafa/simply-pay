<?php

namespace App\Domain\Contracts\Exceptions;

interface StatusCode
{
    /**
     * @return integer
     */
    public function getStatusCode(): int;
}
