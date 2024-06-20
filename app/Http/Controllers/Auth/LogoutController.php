<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Application\Auth\Logout\Command;
use App\Domain\Application\Auth\Logout\Handler;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class LogoutController extends Controller
{

    function __construct(private Handler $handler)
    {
    }

    public function logout(Request $request)
    {
        $this->handler->handle(new Command(
            $request->user()->token(),
            $request->user()
        ));

        return new Response();
    }
}
