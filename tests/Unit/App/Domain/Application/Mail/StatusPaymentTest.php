<?php

namespace Tests\Unit\App\Domain\Application\Mail;

use App\Domain\Application\Notifications\StatusPayment;
use App\Domain\Models\User;
use App\Domain\Models\UserCommon;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class StatusPaymentTest extends TestCase
{
    protected ?UserCommon $userCommonFactory = null;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->userCommonFactory = UserCommon::factory()->create();
    }

    public function testMailNotification()
    {
        $this->userCommonFactory = User::find(1);

        Notification::fake();

        $this->userCommonFactory->notify(new StatusPayment($this->userCommonFactory, "some test message"));

        Notification::assertSentTo($this->userCommonFactory, StatusPayment::class, function ($notification, $channels) {
            $this->assertContains('mail', $channels);
            return true;
        });
    }
}
