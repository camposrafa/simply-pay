<?php

namespace App\Domain\Application\Notifications;

use App\Domain\Application\Mail\SendPaymentNotification;
use App\Domain\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusPayment extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private User $user,
        private string $bodyMessage
    ) {
    }

    /**
     * @return array
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * @return SendPaymentNotification
     */
    public function toMail(): SendPaymentNotification
    {
        return new SendPaymentNotification($this->user, $this->bodyMessage);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            //
        ];
    }
}
