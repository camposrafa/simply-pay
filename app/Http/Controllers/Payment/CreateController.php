<?php

namespace App\Http\Controllers\Payment;

use App\Domain\Application\Payment\Create\Command;
use App\Domain\Application\Payment\Create\Handler;
use App\Http\Controllers\Controller;
use App\Http\Resources\Payment\Payment;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __construct(private Handler $handler)
    {
    }

    public function store(Request $request)
    {
        $paymentCommand = new Command(
            $request->user(),
            $request->get('payee_id'),
            $request->get('amount'),
        );

        return new Payment($this->handler->handle($paymentCommand));
    }
}
