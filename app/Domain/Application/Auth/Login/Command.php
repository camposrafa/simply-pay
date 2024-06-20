<?php

namespace App\Domain\Application\Auth\Login;

class Command
{

    /**
     * @param string $email
     * @param string $password
     */
    function __construct(
        private string $email,
        private string $password
    ) {
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
}
