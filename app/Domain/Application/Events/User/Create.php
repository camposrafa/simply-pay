<?php

namespace App\Domain\Application\Events\User;

use App\Domain\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Create
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    function __construct(
        private User $user
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }
}
