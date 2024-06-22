<?php

namespace App\Domain\Contracts;

interface CheckerRepository
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
