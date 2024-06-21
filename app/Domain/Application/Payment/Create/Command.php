<?php

namespace App\Domain\Application\Payment\Create;

use App\Domain\Models\User;

class Command
{
    function __construct(
        private User $payer,
        private int $payee,
        private ?float $amount,
    ) {
    }

    public function getPayer(): User
    {
        return $this->payer;
    }

    public function setPayer(User $payer): self
    {
        $this->payer = $payer;
        return $this;
    }

    public function getPayeeId(): int
    {
        return $this->payee;
    }

    public function setPayeeId(int $payee): self
    {
        $this->payee = $payee;
        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }
}
