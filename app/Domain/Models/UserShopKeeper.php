<?php

namespace App\Domain\Models;

use App\Domain\Enum\User\Type;
use App\Domain\Models\User;
use Database\Factories\UserShopKeeperFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserShopKeeper extends User
{
    use HasFactory;

    protected static $singleTableType = 'shopkeeper';

    /**
     * @var array
     */
    protected $attributes = [
        'type' => Type::shopkeeper,
    ];

    protected static function newFactory()
    {
        return UserShopKeeperFactory::new();
    }
}
