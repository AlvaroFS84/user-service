<?php

namespace App\Application\UseCase;

use App\Application\Command\CreateUserCommand;
use App\Domain\Entity\User;
use App\Domain\Exception\InvalidParameterException;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Id;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\Surname;
use RuntimeException;


class CreateUserUseCase
{

    public function __construct(
        private UserRepositoryInterface $userRepository
    ){}

    public function __invoke(CreateUserCommand $createUserCommand):void
    {
        try{
            $user = new User(
                new Id($createUserCommand->getId()),
                new Name($createUserCommand->getName()),
                new Surname($createUserCommand->getSurname()),
                new Email($createUserCommand->getEmail()),
                new Password($createUserCommand->getPassword())
            );
            
        }catch(InvalidParameterException $e){
            throw new RuntimeException("Error creating user: " . $e->getMessage());
        }

        $this->userRepository->save($user);
    }
}