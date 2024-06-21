<?php

namespace App\Domain\Application\Jobs;

use App\Domain\Infra\Eloquent\PaymentRepository;
use App\Domain\Infra\Eloquent\UserRepository;
use App\Domain\Infra\RmFinances\CheckerRepository;
use App\Domain\Models\Payment;
use App\Domain\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class Checker extends CheckerRepository implements ShouldQueue
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
        if (!$this->authorize()) {
            throw new Exception('transaction cant be completed. Try again later');
        }

        $userRepository = App::make(UserRepository::class);
        $paymentRepository = App::make(PaymentRepository::class);

        $userRepository->save($this->payer->setAmount($this->payer->getBalance() - $this->payment->getAmount()));
        $userRepository->save($this->payee->setAmount($this->payee->getBalance() + $this->payment->getAmount()));
        $paymentRepository->save($this->payment->setDeliveredAt(Carbon::now()));

        return true;
    }
}
