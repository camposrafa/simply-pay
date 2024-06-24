<?php

namespace Tests\Unit\App\Domain\Application\Payment;

use App\Domain\Application\Payment\List\Command;
use App\Domain\Application\Payment\List\Handler;
use App\Domain\Enum\Payment\Status;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ListPaymentTest extends TestCase
{
    public function testListUserPayment(): void
    {
        $this->setUp();
        $handler = App::make(Handler::class);

        $payment = $handler->handle(new Command(
            ['payer_id' => 1]
        ));

        $this->assertEquals(1, $payment->first()->getPayerId());
        $this->assertEquals(2, $payment->first()->getPayeeId());
        $this->assertEquals(10, $payment->first()->getAmount());
        $this->assertEquals(Status::success, $payment->first()->getStatus());
        $this->assertEquals(null, $payment->first()->getDeliveredAt());
    }
}
