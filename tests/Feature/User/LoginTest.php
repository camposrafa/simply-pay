<?php

namespace Tests\Feature\User;

use Exception;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_user_can_login_whit_correct_info(): void
    {
        $response = $this->post('/auth', ['email' => 'email@email.com', 'password' => '12345678']);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
