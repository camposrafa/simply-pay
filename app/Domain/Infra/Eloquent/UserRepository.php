<?php

namespace App\Domain\Infra\Eloquent;

use App\Domain\Contracts\UserRepository as UserRepositoryInterface;
use App\Domain\Models\User;

class UserRepository implements UserRepositoryInterface
{

    /** @inheritDoc */
    public function getByEmail(string $email): ?User
    {
        return User::where("email", $email)->first();
    }

    /** @inheritDoc */
    public function save(User $user): User
    {
        $user->save();
        $user->refresh();

        return $user;
    }

    /** @inheritDoc */
    public function getOne(array $filter): ?User
    {
        return User::where($filter)->first();
    }
}
