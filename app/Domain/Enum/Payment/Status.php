<?php

namespace App\Domain\Enum\Payment;

enum Status: string
{
    case success = 'success';
    case fail = 'fail';
}
