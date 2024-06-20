<?php

namespace App\Domain\Application\Jobs;

use App\Domain\Infra\RmFinances\CheckerRepository;
use App\Domain\Models\Payment;
use App\Domain\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Checker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    function __construct(
        private User $payer,
        private User $payee,
        private Payment $payment
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): bool
    {
        // $this->authorize();
        return true;
    }
}
