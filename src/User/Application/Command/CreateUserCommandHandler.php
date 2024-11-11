<?php

namespace App\User\Application\Command;

use App\User\Application\UseCase\CreateUserUseCase;

class CreateUserCommandHandler
{
    public function __construct(private CreateUserUseCase $createUserUseCase)
    {}

    public function __invoke(CreateUserCommand $createUserCommand)
    {
        $this->createUserUseCase->__invoke($createUserCommand);
    }
}