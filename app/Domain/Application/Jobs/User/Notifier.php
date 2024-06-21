<?php

namespace App\Domain\Application\Jobs\User;

use App\Domain\Application\Notifications\StatusPayment;
use App\Domain\Infra\RmFinances\CheckerRepository;
use App\Domain\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class Notifier implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 10;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $retryAfter = 5;

    function __construct(
        private User $user
    ) {
    }

    public function handle()
    {
        $checkerRepository = App::make(CheckerRepository::class);

        if ($checkerRepository->notifier()) {
            $this->user->notify(new StatusPayment($this->user));
        }
    }
}
