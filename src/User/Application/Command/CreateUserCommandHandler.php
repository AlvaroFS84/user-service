<?php

namespace App\Application\Command;

use App\Application\UseCase\CreateUserUseCase;

class CreateUserCommandHandler
{
    public function __construct(private CreateUserUseCase $createUserUseCase)
    {}

    public function __invoke(CreateUserCommand $createUserCommand)
    {
        $this->createUserUseCase->__invoke($createUserCommand);
    }
}