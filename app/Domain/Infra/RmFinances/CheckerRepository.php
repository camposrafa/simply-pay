<?php

namespace App\Domain\Infra\RmFinances;

use App\Domain\Contracts\CheckerRepository as ContractsCheckerRepository;
use Exception;
use GuzzleHttp\Client;

class CheckerRepository extends Client implements ContractsCheckerRepository
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
    public function notifier()
    {
        return $this->request('POST', 'https://util.devi.tools/api/v1/notify', []);
    }
}
