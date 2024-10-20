<?php

namespace App\Application\UseCase;

use App\Application\Command\CreateUserCommand;
use App\Domain\Entity\User;
use App\Domain\Exception\InvalidParameterException;
use App\Domain\Exception\MultipleParametersErrorException;
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
        $errors = []; // Array para acumular errores

        try {
            $name = new Name($createUserCommand->getName());
        } catch (InvalidParameterException $e) {
            $errors[] = $e->getMessage();
        }

        try {
            $surname = new Surname($createUserCommand->getSurname());
        } catch (InvalidParameterException $e) {
            $errors[] = $e->getMessage();
        }

        try {
            $email = new Email($createUserCommand->getEmail());
        } catch (InvalidParameterException $e) {
            $errors[] = $e->getMessage();
        }

        try {
            $password = new Password($createUserCommand->getPassword());
        } catch (InvalidParameterException $e) {
            $errors[] = $e->getMessage();
        }

        if (!empty($errors)) {
            throw new MultipleParametersErrorException($errors);
        }

        $user = new User(
            Uuid::uuid4(),
            $name,
            $surname,
            $email,
            $password
        );
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