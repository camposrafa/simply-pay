<?php

namespace App\Domain\Models;

use App\Domain\Enum\User\Type;
use Database\Factories\UserCommonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCommon extends User
{
    use HasFactory;

    protected static $singleTableType = "common";

    /**
     * @var array
     */
    protected $attributes = [
        'type' => Type::common,
    ];

    protected static function newFactory()
    {
        return UserCommonFactory::new();
    }
}
