<?php

namespace Tests\Feature\User;

use App\Domain\Application\Exceptions\ModelNotFoundException;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testUserCanLoginWhitCorrectInfo(): void
    {
        $response = $this->post('/auth', ['email' => 'user_common@email.com.br', 'password' => '12345678']);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUserCantLoginWhitIncorrectEmail(): void
    {
        $this->expectException(ModelNotFoundException::class);
        $this->expectExceptionMessage("user not found!");

        $this->post('/auth', ['email' => 'user_commona@email.com.br', 'password' => '12345678']);
    }
}
