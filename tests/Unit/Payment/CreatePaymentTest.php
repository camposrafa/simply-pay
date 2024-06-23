<?php

namespace Tests\Unit\Payment;

use App\Domain\Application\Exceptions\ModelNotFoundException;
use App\Domain\Application\Exceptions\NotAcceptableException;
use App\Domain\Application\Exceptions\UnauthorizedException;
use App\Domain\Application\Payment\Create\Command;
use App\Domain\Application\Payment\Create\Handler;
use App\Domain\Models\UserCommon;
use App\Domain\Models\UserShopKeeper;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class CreatePaymentTest extends TestCase
{
    use WithFaker;

    protected ?Handler $handler = null;

    protected ?UserShopKeeper $userShopkeeperFactory = null;

    protected ?UserCommon $userCommonFactory = null;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->userShopkeeperFactory = UserShopKeeper::factory()->create();
        $this->userCommonFactory = UserCommon::factory()->create();
        $this->handler = App::make(Handler::class);
    }

    public function testUserShopkeerperCantDoPayments()
    {
        $this->expectExceptionMessage('you can not make payments');
        $this->expectException(UnauthorizedException::class);

        $this->handler->handle(new Command(
            $this->userShopkeeperFactory,
            $this->userCommonFactory->getId(),
            10
        ));
    }

    public function testVerifyIfUserBalanceIsEnough()
    {
        $this->expectExceptionMessage("insufficient funds");
        $this->expectException(NotAcceptableException::class);

        $this->handler->handle(new Command(
            $this->userCommonFactory,
            $this->userShopkeeperFactory->getId(),
            10
        ));
    }

    public function testVerifyIfPayeeExist()
    {
        $this->expectExceptionMessage("Payee not found");
        $this->expectException(ModelNotFoundException::class);

        $this->handler->handle(new Command(
            $this->userCommonFactory,
            999,
            10
        ));
    }
}
