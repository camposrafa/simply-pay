<?php

namespace Tests\Feature\User;

use Tests\CreatesApplication;
use Tests\InteractWithUsers;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use CreatesApplication, InteractWithUsers;

    public function testUserCanLoginWhitCorrectInfo(): void
    {
        $response = $this->post('/auth', ['email' => 'user_common@email.com.br', 'password' => '12345678']);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetInfoUserLogged(): void
    {
        $this->setUpUser();
        $response = $this->get('/logged');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('200', $response->getStatusCode());
    }
}
