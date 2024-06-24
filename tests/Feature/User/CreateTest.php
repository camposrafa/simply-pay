<?php

namespace Tests\Feature\User;

use App\Domain\Enum\User\Document;
use App\Domain\Enum\User\Type;
use App\Domain\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use CreatesApplication, WithFaker;

    /**
     * @var User
     */
    protected User $user;

    public function createUser(): void
    {
        $response = $this->post(
            '/user',
            [
                'name' => $this->faker()->name,
                'type' => Type::common,
                'document' => $this->faker()->document,
                'documenttype' => Document::cpf,
                'email' => $this->faker()->safeEmail,
                'password' => $this->faker()->word,
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
    }
}
