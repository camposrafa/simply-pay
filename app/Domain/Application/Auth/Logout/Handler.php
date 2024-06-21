<?php

namespace App\Domain\Application\Auth\Logout;

use App\Domain\Application\Auth\Logout\Command;

class Handler
{
    /**
     *
     * @param Command $command
     * @throws Exception
     * @return boolean
     */
    public function handle(Command $command): bool
    {
        $command->getToken()->revoke();
        return true;
    }
}
