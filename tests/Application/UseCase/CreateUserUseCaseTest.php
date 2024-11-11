<?php

namespace App\Tests\Application\UseCase;

use App\User\Application\UseCase\CreateUserUseCase;
use App\User\Application\Command\CreateUserCommand;
use App\User\Domain\Entity\User;
use App\User\Domain\Exception\EmailAlreadyExistsException;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\Email;
use App\User\Domain\ValueObject\Name;
use App\User\Domain\ValueObject\Password;
use App\User\Domain\ValueObject\Surname;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserUseCaseTest extends TestCase
{
    private UserRepositoryInterface $userRepository;
    private UserPasswordHasherInterface $passwordHasher;
    private CreateUserUseCase $createUserUseCase;

    public function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->passwordHasher = $this->createMock(UserPasswordHasherInterface::class);

        $this->createUserUseCase = new CreateUserUseCase($this->userRepository, $this->passwordHasher);
    }

    public function testThrowExceptionIfUserAlreadyExists(): void
    {
        $command = new CreateUserCommand('testEmail@mail.com','name','surname','12345');

        $this->userRepository
            ->expects($this->once())
            ->method('findByEmail')
            ->with($command->getEmail())
            ->willReturn(new User(
                Uuid::uuid4(),
                new Name('name'),
                new Surname('surname'),
                new Email('testEmail@mail.com'),
                new Password('12345')
            ));

        $this->expectException(EmailAlreadyExistsException::class);

        $this->createUserUseCase->__invoke($command);
    }
}