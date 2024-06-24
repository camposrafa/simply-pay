<?php

namespace App\Domain\Infra\Integration;

use App\Domain\Contracts\AuthorizerRepository as ContractsAuthorizerRepository;
use GuzzleHttp\Client;

class AuthorizerRepository extends Client implements ContractsAuthorizerRepository
{

    /** @inheritDoc */
    public function authorize()
    {
        return $this->request('GET', 'https://util.devi.tools/api/v2/authorize', []);
    }

    /** @inheritDoc */
    public function notifier()
    {
        return $this->request('POST', 'https://util.devi.tools/api/v1/notify', []);
    }
}
