<?php

namespace Tests\Unit\Payment;

use App\Domain\Application\Payment\Create\Command;
use App\Domain\Application\Payment\Create\Handler;
use App\Domain\Models\User;
use Illuminate\Support\Facades\App;
use Tests\CreatesApplication;
use Tests\InteractWithUsers;
use Tests\TestCase;

class CreatePaymentTest extends TestCase
{
    use CreatesApplication, InteractWithUsers;

    /**
     * @var User
     */
    protected User $user;

    public function testIfPaymentHasBeenProcessed(): void
    {
        $handler = App::make(Handler::class);

        $payment = $handler->handle(new Command(
            User::find(1),
            2,
            10
        ));

        $this->assertEquals($payment->getAmount(), 10);
    }
}
