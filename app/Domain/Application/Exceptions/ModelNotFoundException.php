<?php

namespace App\Domain\Application\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ModelNotFoundException extends BaseException
{

    /** @inheritDoc */
    public function getStatusCode(): int
    {
        return Response::HTTP_NOT_FOUND;
    }
}
