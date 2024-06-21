<?php

namespace App\Domain\Application\Jobs;

use App\Domain\Enum\Payment\Status;
use App\Domain\Infra\Eloquent\PaymentRepository;
use App\Domain\Infra\Eloquent\UserRepository;
use App\Domain\Infra\RmFinances\CheckerRepository;
use App\Domain\Models\Payment;
use App\Domain\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

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
    public function handle(): Payment
    {
        $userRepository = App::make(UserRepository::class);
        $paymentRepository = App::make(PaymentRepository::class);
        $checkerRepository = App::make(CheckerRepository::class);

        if ($checkerRepository->authorize()) {
            $userRepository->save($this->payer->setBalance($this->payer->getBalance() - $this->payment->getAmount()));
            $userRepository->save($this->payee->setBalance($this->payee->getBalance() + $this->payment->getAmount()));
            $payment = $paymentRepository->save(
                $this->payment
                    ->setDeliveredAt(Carbon::now())
                    ->setStatus(Status::success)
            );
        } else {
            $payment = $paymentRepository->save($this->payment->setStatus(Status::fail));
        }

        return $payment;
    }
}
