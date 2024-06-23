<?php

namespace Database\Factories;

use App\Domain\Enum\User\Document;
use App\Domain\Enum\User\Type;
use App\Domain\Models\UserCommon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserCommonFactory extends Factory
{
    protected $model = UserCommon::class;
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'type' => Type::common,
            'email' => fake()->unique()->safeEmail(),
            'document_type' => Document::cpf,
            'document' => fake()->word(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
