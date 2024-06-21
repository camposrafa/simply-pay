<?php

namespace App\Http\Controllers\Payment;

use App\Domain\Application\Payment\Create\Command;
use App\Domain\Application\Payment\Create\Handler;
use App\Domain\Models\UserShopKeeper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Payment\Payment;
use Exception;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __construct(private Handler $handler)
    {
    }

    public function store(Request $request)
    {
        if ($request->user() instanceof UserShopKeeper) {
            throw new Exception('you cannot make payments');
        }

        $paymentCommand = new Command(
            $request->user(),
            $request->get('payee_id'),
            $request->get('amount'),
        );

        return new Payment($this->handler->handle($paymentCommand));
    }
}
