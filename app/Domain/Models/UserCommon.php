<?php

namespace App\Domain\Models;

use App\Domain\Enum\User\Type;
use Database\Factories\UserFactory;

class UserCommon extends User
{
    protected static $singleTableType = "common";

    /**
     * @var array
     */
    protected $attributes = [
        'type' => Type::common,
    ];

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
