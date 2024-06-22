<?php

namespace App\Domain\Application\User\Create;

use App\Domain\Application\Exceptions\ResourceAlreadyExists;
use App\Domain\Contracts\UserRepository;
use App\Domain\Application\User\Create\Command;
use App\Domain\Models\User;
use Exception;

class Handler
{
    /**
     * @param UserRepository $userRepository
     */
    function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function handle(Command $command)
    {

        $email = $this->userRepository->getByEmail($command->getEmail());

        if (!is_null($email)) {
            throw new Exception('email already used');
        }

        return $this->userRepository->save(
            (new User())
                ->setName($command->getName())
                ->setType($command->getType())
                ->setDocument($command->getDocument())
                ->setDocumentType($command->getDocumentType())
                ->setEmail($command->getEmail())
                ->setPassword($command->getPassword())
        );
    }
}
