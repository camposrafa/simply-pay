<?php

namespace App\Domain\Contracts;

use App\Domain\Models\User;

interface UserRepository
{
    /**
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): ?User;

    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User;

    /**
     * @param array $filter
     * @return User|null
     */
    public function getOne(array $filter): ?User;
}
