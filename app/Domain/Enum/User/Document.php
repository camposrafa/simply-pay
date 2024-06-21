<?php

namespace App\Domain\Enum\User;

enum Document: string
{
    case cpf = 'cpf';
    case cnpj = 'cnpj';
}
