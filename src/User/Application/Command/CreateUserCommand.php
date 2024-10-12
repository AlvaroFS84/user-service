<?php

namespace App\Application\Command;

class CreateUserCommand
{
    
    public function __construct(
        private string $id,
        private string $email,
        private string $name,
        private string $surname,
        private string $password
    ){}

    public function getId():string{
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
