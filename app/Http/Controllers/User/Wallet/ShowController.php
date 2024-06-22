<?php

namespace App\Http\Controllers\User\Wallet;

use App\Http\Controllers\Controller;
use App\Domain\Application\User\Wallet\Show\Command;
use App\Domain\Application\User\Wallet\Show\Handler;
use App\Http\Resources\User\Wallet\Wallet;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __construct(private Handler $handler)
    {
    }

    public function show(Request $request, int $userId)
    {
        return new Wallet(
            $this->handler->handle(new Command(['user_id' => $userId]))
        );
    }
}
