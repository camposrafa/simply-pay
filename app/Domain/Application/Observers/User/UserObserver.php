<?php

namespace App\Domain\Application\Observers\User;

use App\Domain\Application\Jobs\User\Notifier;
use App\Domain\Models\User;

class UserObserver
{

    /**
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        if ($user->isDirty('balance')) {
            Notifier::dispatch($user);
        }
    }
}
