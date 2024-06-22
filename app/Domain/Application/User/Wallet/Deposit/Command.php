<?php

namespace App\Domain\Application\User\Wallet\Deposit;

class Command
{
    function __construct(
        private int $userId,
        private ?float $balance,
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(?float $balance): self
    {
        $this->balance = $balance;
        return $this;
    }
}
