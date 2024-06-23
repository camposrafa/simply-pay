<?php

namespace App\Domain\Application\User\Create\Concrete;

use App\Domain\Contracts\Application\User\CreateStrategy as UserCreateStrategy;
use App\Domain\Models\User;
use App\Domain\Models\UserCommon;

class Common implements UserCreateStrategy
{

    public function createUser(): User
    {
        return new UserCommon();
    }
}
