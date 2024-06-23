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
use Illuminate\Support\Facades\App;
use Psr\Http\Message\ResponseInterface;

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
        private User $user
    ) {
    }

    public function handle()
    {
        $authorizerRepository = App::make(AuthorizerRepository::class);

        if ($authorizerRepository->notifier() instanceof ResponseInterface) {
            $this->user->notify(new StatusPayment($this->user));
        }
    }
}
