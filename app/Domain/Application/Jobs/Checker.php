<?php

namespace App\Domain\Application\Jobs;

use App\Domain\Application\Jobs\User\Notifier;
use App\Domain\Enum\Payment\Status;
use App\Domain\Infra\Eloquent\PaymentRepository;
use App\Domain\Infra\Eloquent\WalletRepository;
use App\Domain\Infra\Integration\AuthorizerRepository;
use App\Domain\Models\Payment;
use App\Domain\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class Checker implements ShouldQueue
{
    private PaymentRepository $paymentRepository;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    function __construct(
        private ?User $payer,
        private User $payee,
        private Payment $payment
    ) {
        $this->paymentRepository = new PaymentRepository();
    }

    /**
     * Execute the job.
     */
    public function handle(WalletRepository $walletRepository, AuthorizerRepository $authorizerRepository): Payment
    {

        $authorizerRepository->authorize();

        if (!is_null($this->payer)) {
            $payerWallet = $this->payer->getWallet();
            $walletRepository->save($payerWallet->setBalance($payerWallet->getBalance() - $this->payment->getAmount()));
        }

        $payeeWallet = $this->payee->getWallet();

        $walletRepository->save($payeeWallet->setBalance($payeeWallet->getBalance() + $this->payment->getAmount()));

        return $this->paymentRepository->save(
            $this->payment
                ->setDeliveredAt(Carbon::now())
                ->setStatus(Status::success)
        );
    }

    /**
     * Handle a job failure.
     */
    public function failed()
    {
        $payment = $this->paymentRepository->save(
            $this->payment->setStatus(Status::fail)
        );

        Notifier::dispatch($payment->getPayer(), "The payment wasn't be completed. Try again later");
    }
}
