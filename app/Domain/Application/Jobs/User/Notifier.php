<?php

namespace App\Domain\Application\Jobs\User;

use App\Domain\Application\Notifications\StatusPayment;
use App\Domain\Infra\Integration\AuthorizerRepository;
use App\Domain\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Notifier implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 10;

    function __construct(
        private User $user,
        private string $message
    ) {
    }

    public function handle(AuthorizerRepository $authorizerRepository)
    {
        $authorizerRepository->notifier();
        $this->user->notify(new StatusPayment($this->user, $this->message));
    }
}
