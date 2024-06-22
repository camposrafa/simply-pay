<?php

namespace App\Http\Controllers\User\Wallet;

use App\Domain\Application\User\Wallet\Deposit\Command;
use App\Domain\Application\User\Wallet\Deposit\Handler;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Wallet\Wallet;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function __construct(private Handler $handler)
    {
    }

    public function store(int $userId, Request $request)
    {
        $paymentCommand = new Command(
            $userId,
            $request->get('balance'),
        );

        return new Wallet(
            $this->handler->handle($paymentCommand)
        );
    }
}
