<?php

namespace Tests\Unit\User\Wallet;

use App\Domain\Application\User\Wallet\Show\Command;
use App\Domain\Application\User\Wallet\Show\Handler;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ShowWalletTest extends TestCase
{
    public function testShowUserWallet(): void
    {
        $this->setUp();
        $handler = App::make(Handler::class);

        $wallet = $handler->handle(new Command(
            ['user_id' => 1]
        ));

        $this->assertNotNull($wallet);
        $this->assertEquals(1, $wallet->getUserId());
        $this->assertNotNull($wallet->getBalance());
    }
}
