<?php

namespace Tests\Unit\Payment;

use App\Domain\Application\Payment\List\Command as ListCommand;
use App\Domain\Application\Payment\List\Handler as ListHandler;
use App\Domain\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\LazyCollection;
use Tests\CreatesApplication;
use Tests\InteractWithUsers;
use Tests\TestCase;

class ListPaymentTest extends TestCase
{
    use CreatesApplication, InteractWithUsers;

    /**
     * @var User
     */
    protected User $user;

    public function testListAllPayments(): void
    {
        $this->setUp();
        $handler = App::make(ListHandler::class);

        $payments = $handler->handle(new ListCommand(
            ['payee_id' => 1]
        ));

        $this->assertEquals(LazyCollection::class, $payments);
    }
}
