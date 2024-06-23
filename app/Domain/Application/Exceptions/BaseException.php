<?php

namespace App\Domain\Application\Exceptions;

use App\Domain\Contracts\Exceptions\StatusCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class BaseException extends Exception implements StatusCode
{

    /** @inheritDoc */
    public abstract function getStatusCode(): int;

    /**
     * @param Request $request
     * @return Response
     */
    public function render(Request $request): Response
    {
        return new Response([
            'message' => $this->getMessage()
        ], $this->getStatusCode());
    }
}
