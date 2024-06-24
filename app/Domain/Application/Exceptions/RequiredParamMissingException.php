<?php

namespace App\Domain\Application\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class RequiredParamMissingException extends BaseException
{

    /** @inheritDoc */
    public function getStatusCode(): int
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }
}
