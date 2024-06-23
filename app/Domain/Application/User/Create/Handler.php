<?php

namespace App\Domain\Application\User\Create;

use App\Domain\Application\Exceptions\ResourceAlreadyExists;
use App\Domain\Contracts\UserRepository;
use App\Domain\Application\User\Create\Command;

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
            throw new ResourceAlreadyExists('email already used');
        }

        $document = $this->userRepository->getOne(['document' => $command->getDocument()]);

        if (!is_null($document)) {
            throw new ResourceAlreadyExists('document number already used');
        }

        $user = (Factory::create($command->getType()))->createUser();

        return $this->userRepository->save(
            $user
                ->setName($command->getName())
                ->setType($command->getType())
                ->setDocument($command->getDocument())
                ->setDocumentType($command->getDocumentType())
                ->setEmail($command->getEmail())
                ->setPassword($command->getPassword())
        );
    }
}
