<?php

namespace App\Domain\Application\Jobs;

use App\Domain\Enum\Payment\Status;
use App\Domain\Infra\Eloquent\PaymentRepository;
use App\Domain\Infra\Eloquent\WalletRepository;
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
        private ?User $payer,
        private User $payee,
        private Payment $payment
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): Payment
    {
        $walletRepository = App::make(WalletRepository::class);
        $paymentRepository = App::make(PaymentRepository::class);
        $checkerRepository = App::make(CheckerRepository::class);

        if (!$checkerRepository->authorize()) {
            return $paymentRepository->save($this->payment->setStatus(Status::fail));
        }

        if (!is_null($this->payer)) {
            $payerWallet = $this->payer->getWallet();
            $walletRepository->save($payerWallet->setBalance($payerWallet->getBalance() - $this->payment->getAmount()));
        }

        $payeeWallet = $this->payee->getWallet();

        $walletRepository->save($payeeWallet->setBalance($payeeWallet->getBalance() + $this->payment->getAmount()));

        return $paymentRepository->save(
            $this->payment
                ->setDeliveredAt(Carbon::now())
                ->setStatus(Status::success)
        );
    }
}
