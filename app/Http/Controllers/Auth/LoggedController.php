<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;
use Illuminate\Http\Request;

class LoggedController extends Controller
{

    /**
     * @param Request $request
     * @return UserResource
     */
    public function logged(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
