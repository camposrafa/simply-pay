<?php

namespace App\Domain\Application\User\Create;

use App\Domain\Enum\User\Document;
use App\Domain\Enum\User\Type;
use App\Domain\Models\User;

class Command
{
    function __construct(
        private string $name,
        private Type $type,
        private string $document,
        private Document $documentType,
        private string $email,
        private string $password,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function setType(Type $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function setDocument(string $document): self
    {
        $this->document = $document;
        return $this;
    }

    public function getDocumentType(): Document
    {
        return $this->documentType;
    }

    public function setDocumentType(Document $documentType): self
    {
        $this->documentType = $documentType;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
}
