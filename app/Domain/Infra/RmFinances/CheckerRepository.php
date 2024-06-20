<?php

namespace App\Domain\Infra\RmFinances;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;

class CheckerRepository extends GuzzleClient
{
    /** @inheritDoc */
    public function authorize(): mixed
    {
        return $this->getHttpClient()->get('https://util.devi.tools/api/v2/authorize');
    }

    /** @inheritDoc */
    public function notifier(): mixed
    {
        return $this->getHttpClient()->post('https://util.devi.tools/api/v1/notify');
    }
}
