<?php

namespace App\Application\UseCase;

use App\Application\Command\CreateUserCommand;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\Surname;
use Ramsey\Uuid\Uuid;


class CreateUserUseCase
{

    public function __construct(
        private UserRepositoryInterface $userRepository
    ){}

    public function __invoke(CreateUserCommand $createUserCommand):void
    {
        $user = new User(
            Uuid::uuid4(),
            new Name($createUserCommand->getName()),
            new Surname($createUserCommand->getSurname()),
            new Email($createUserCommand->getEmail()),
            new Password($createUserCommand->getPassword())
        );
            
        $this->userRepository->save($user);
    }
}