<?php

namespace App\Http\Controllers\User;

use App\Domain\Application\User\Create\Command;
use App\Domain\Application\User\Create\Handler;
use App\Domain\Enum\User\Document;
use App\Domain\Enum\User\Type;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\User;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __construct(private Handler $handler)
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'name',
            'type',
            'document',
            'document_type',
            'email',
            'password',
        ]);

        $userCommand = new Command(
            $request->get('name'),
            Type::from($request->get('type')),
            $request->get('document'),
            Document::from($request->get('document_type')),
            $request->get('email'),
            $request->get('password'),
        );

        return new User($this->handler->handle($userCommand));
    }
}
