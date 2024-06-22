<?php

namespace Tests;

use App\Domain\Models\User;
use Laravel\Passport\Passport;

trait InteractWithUsers
{
    public function setUpUser(array $attributes = [])
    {
        $this->logout();

        $this->user = User::factory(1);

        $this->login();

        return $this;
    }

    public function login()
    {
        Passport::actingAs($this->user);
    }

    public function logout()
    {
        $this->user = null;
    }
}
