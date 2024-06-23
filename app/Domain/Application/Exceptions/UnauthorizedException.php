<?php

namespace App\Domain\Application\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class UnauthorizedException extends BaseException
{

    /** @inheritDoc */
    public function getStatusCode(): int
    {
        return Response::HTTP_UNAUTHORIZED;
    }
}
