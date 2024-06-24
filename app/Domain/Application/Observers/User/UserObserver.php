<?php

namespace App\Domain\Application\Observers\User;

use App\Domain\Application\Events\User\Create;
use App\Domain\Models\User;

class UserObserver
{

    /**
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        Create::dispatch($user);
    }
}
