<?php

namespace App\User\Application\UseCase;

use App\User\Application\Command\CreateUserCommand;
use App\User\Domain\Entity\User;
use App\User\Domain\Exception\EmailAlreadyExistsException;
use App\User\Domain\Exception\InvalidParameterException;
use App\User\Domain\Exception\MultipleParametersErrorException;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\Name;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\Surname;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserUseCase
{
    //crear un contructor private y refactorizar la parte del password

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserPasswordHasherInterface $passwordHasher
    ){}

    public function __invoke(CreateUserCommand $createUserCommand):void
    {
        $errors = []; // Array para acumular errores

        $user  =  $this->userRepository->findByEmail($createUserCommand->getEmail());

        if(!is_null($user)){
            throw new EmailAlreadyExistsException();
        }

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

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $createUserCommand->getPassword()
        );
        $user->setVOPassword(new Password($hashedPassword));
            
        $this->userRepository->save($user);
    }
}