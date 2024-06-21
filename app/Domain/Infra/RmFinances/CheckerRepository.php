<?php

namespace App\Domain\Infra\RmFinances;

use Exception;
use GuzzleHttp\Client as GuzzleClient;

class CheckerRepository extends GuzzleClient
{
    /** @inheritDoc */
    public function authorize(): bool
    {
        try {
            $this->request('GET', 'https://util.devi.tools/api/v2/authorize', []);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    /** @inheritDoc */
    public function notifier(): bool
    {
        try {
            $this->request('POST', 'https://util.devi.tools/api/v1/notify', []);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
