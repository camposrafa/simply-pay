<?php

namespace App\Domain\Application\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ResourceAlreadyExists extends BaseException
{

    /** @inheritDoc */
    public function getStatusCode(): int
    {
        return Response::HTTP_CONFLICT;
    }
}
