<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Domain\Application\Payment\List\Command;
use App\Domain\Application\Payment\List\Handler;
use App\Http\Resources\Payment\PaymentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ListController extends Controller
{
    public function __construct(private Handler $handler)
    {
    }

    public function list(Request $request)
    {
        $filter = $request->get('filter', []);
        return new PaymentCollection(
            $this->handler->handle(new Command(
                Arr::only(
                    $filter,
                    [
                        'id', 'payer_id', 'payee_id'
                    ]
                ),
            ))
        );
    }
}
