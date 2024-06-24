<?php

namespace Tests\Unit\App\Domain\Application\User;

use App\Domain\Application\Exceptions\ResourceAlreadyExists;
use App\Domain\Application\User\Create\Command;
use App\Domain\Application\User\Create\Handler;
use App\Domain\Enum\User\Document;
use App\Domain\Enum\User\Type;
use App\Domain\Models\UserCommon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use WithFaker;

    protected ?Handler $handler = null;

    protected ?UserCommon $userCommonFactory = null;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->userCommonFactory = UserCommon::factory()->create();
        $this->handler = App::make(Handler::class);
    }

    public function testCreateUserCommon()
    {
        $newUser = $this->handler->handle(
            new Command(
                $this->faker->name,
                Type::common,
                $this->faker->word,
                Document::cpf,
                $this->faker->safeEmail,
                $this->faker->word,
            )
        );

        $this->assertNotNull($newUser->getName());
        $this->assertNotNull($newUser->getEmail());
        $this->assertNotNull($newUser->getType());
        $this->assertNotNull($newUser->getDocument());
        $this->assertNotNull($newUser->getDocumentType());
    }

    public function testCreateUserShopkeeper()
    {
        $newUser = $this->handler->handle(
            new Command(
                $this->faker->name,
                Type::shopkeeper,
                $this->faker->word,
                Document::cnpj,
                $this->faker->safeEmail,
                $this->faker->word,
            )
        );

        $this->assertNotNull($newUser->getName());
        $this->assertNotNull($newUser->getEmail());
        $this->assertNotNull($newUser->getType());
        $this->assertNotNull($newUser->getDocument());
        $this->assertNotNull($newUser->getDocumentType());
    }

    public function testFailToCreateUserWithEmailAlreadyUsed()
    {
        $this->expectExceptionMessage('email already used');
        $this->expectException(ResourceAlreadyExists::class);

        $this->handler->handle(
            new Command(
                $this->faker->name,
                Type::shopkeeper,
                $this->faker->word,
                Document::cnpj,
                $this->userCommonFactory->getEmail(),
                $this->faker->word,
            )
        );
    }

    public function testFailToCreateUserWithDocumentAlreadyUsed()
    {
        $this->expectExceptionMessage('document number already used');
        $this->expectException(ResourceAlreadyExists::class);

        $this->handler->handle(
            new Command(
                $this->faker->name,
                Type::shopkeeper,
                "547.974.880-77",
                Document::cnpj,
                $this->faker->safeEmail,
                $this->faker->word,
            )
        );
    }

    public function testCreateWalletWhenUserIsCreated()
    {
        $newUser = $this->handler->handle(
            new Command(
                $this->faker->name,
                Type::common,
                $this->faker->word,
                Document::cpf,
                $this->faker->safeEmail,
                $this->faker->word,
            )
        );

        $this->assertNotNull($newUser->getWallet());
        $this->assertEquals($newUser->getWallet()->getBalance(), 0);
    }
}
