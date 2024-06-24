<?php

namespace App\Domain\Contracts\Application\User;

use App\Domain\Models\User;

interface CreateStrategy
{
    public function createUser(): User;
}
