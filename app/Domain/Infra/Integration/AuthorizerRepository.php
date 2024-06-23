<?php

namespace App\Domain\Infra\Integration;

use App\Domain\Contracts\AuthorizerRepository as ContractsAuthorizerRepository;
use App\Domain\Enum\Payment\Status;
use Exception;
use GuzzleHttp\Client;

class AuthorizerRepository extends Client implements ContractsAuthorizerRepository
{

    /** @inheritDoc */
    public function authorize(): Status
    {
        try {
            $this->request('GET', 'https://util.devi.tools/api/v2/authorize', []);
            return Status::success;
        } catch (Exception $ex) {
            return Status::fail;
        }
    }

    /** @inheritDoc */
    public function notifier()
    {
        return $this->request('POST', 'https://util.devi.tools/api/v1/notify', []);
    }
}
