<?php

namespace App\Domain\Application\User\Wallet\Show;

class Command
{
    function __construct(
        private ?array $filter
    ) {
    }

    public function getFilter(): ?array
    {
        return $this->filter;
    }

    public function setFilter(?array $filter = null): self
    {
        $this->filter = $filter;
        return $this;
    }
}
