<?php

namespace App\Domain\Models;

use App\Domain\Enum\User\Type;
use App\Domain\Models\User;
use Database\Factories\UserFactory;

class UserShopKeeper extends User
{

    protected static $singleTableType = 'shopkeeper';

    /**
     * @var array
     */
    protected $attributes = [
        'type' => Type::shopkeeper,
    ];

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
