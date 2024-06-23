<?php

namespace App\Domain\Application\Auth\Login;

use App\Domain\Application\Auth\Login\Command;
use App\Domain\Application\Exceptions\ModelNotFoundException;
use App\Domain\Contracts\UserRepository;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\PersonalAccessTokenResult as AccessToken;

class Handler
{

    /**
     * @param UserRepository $userRepository
     */

    function __construct(
        private UserRepository $userRepository
    ) {
    }

    /**
     * @param Command $command
     * @return AccessToken
     */
    public function handle(Command $command): AccessToken
    {

        $user = $this->userRepository->getByEmail($command->getEmail());

        if (
            !$user || empty($command->getPassword()) || !Hash::check($command->getPassword(), $user->getPassword())
        ) {
            throw new ModelNotFoundException("user not found!");
        }

        return $user->createToken("Password Generated Token");
    }
}
