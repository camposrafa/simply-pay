<?php

namespace Tests\Unit\User;

use App\Domain\Application\Notifications\StatusPayment;
use App\Domain\Models\User;
use Illuminate\Support\Facades\Notification;
use Tests\CreatesApplication;
use Tests\InteractWithUsers;
use Tests\TestCase;

class NotifyTest extends TestCase
{
    use CreatesApplication, InteractWithUsers;
    /**
     * @var User
     */
    protected User $user;

    public function testMailNotification()
    {
        $this->user = User::find(1);
        Notification::fake();
        $this->user->notify($this->user->notify(new StatusPayment($this->user, "some test message")));
        Notification::assertSentTo($this->user, StatusPayment::class, function ($notification, $channels) {
            $this->assertContains('mail', $channels);

            $mailNotification = (object)$notification->toMail($this->user);
            $this->assertEquals("Payment Notification", $mailNotification->subject);
            return true;
        });
    }
}
