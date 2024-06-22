<?php

namespace Tests\Unit\User\Wallet;

use App\Domain\Application\User\Wallet\Deposit\Command as DepositCommand;
use App\Domain\Application\User\Wallet\Deposit\Handler as DepositHandler;
use Illuminate\Support\Facades\App;
use Tests\CreatesApplication;
use Tests\InteractWithUsers;
use Tests\TestCase;

class DepositWalletTest extends TestCase
{
    use CreatesApplication, InteractWithUsers;

    public function testIfDepositIsDone(): void
    {
        $handler = App::make(DepositHandler::class);

        $payment = $handler->handle(new DepositCommand(
            1,
            50,
        ));

        $this->assertEquals($payment->getAmount(), 50);
    }
}
