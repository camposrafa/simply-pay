<?php

namespace App\Domain\Application\User\Create;

use App\Domain\Application\User\Create\Concrete\Common;
use App\Domain\Application\User\Create\Concrete\Shopkeeper;
use App\Domain\Enum\User\Type as UserType;
use App\Domain\Contracts\Application\User\CreateStrategy;
use Illuminate\Support\Facades\App;
use Nette\NotImplementedException as NetteNotImplementedException;

abstract class Factory
{

    public static function create(UserType $type): CreateStrategy
    {
        return match ($type) {
            UserType::common => App::make(Common::class),
            UserType::shopkeeper => App::make(Shopkeeper::class),
            default => new NetteNotImplementedException("not implement yet"),
        };
    }
}
