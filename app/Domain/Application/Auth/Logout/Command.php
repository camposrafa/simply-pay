<?php

namespace App\Domain\Application\Auth\Logout;

use App\Domain\Models\User;
use Laravel\Passport\Token;

class Command
{

    /**
     * @param Token $token
     * @param User $user
     */
    function __construct(
        private Token $token,
        private User $user
    ) {
    }

    public function setToken(Token $token): self
    {
        $this->token = $token;
        return $this;
    }
    public function getToken(): Token
    {
        return $this->token;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
