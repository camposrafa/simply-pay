<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Application\Auth\Login\Command as LoginCommand;
use App\Domain\Application\Auth\Login\Handler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Passport\PersonalAccessTokenResult as AccessToken;

class LoginController extends Controller
{
    /**
     * @param Handler $passwordHandler
     */
    function __construct(private Handler $passwordHandler)
    {
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): AccessToken
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $passwordCommand = new LoginCommand(
            strval($request->input('email')),
            strval($request->input('password'))
        );

        return $this->passwordHandler->handle($passwordCommand);
    }
}
