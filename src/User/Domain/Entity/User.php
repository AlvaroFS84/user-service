<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\Surname;

class User
{
    public function __construct(
        private Name $name,
        private Surname $surname,
        private Password $password
    ) {}

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): Surname
    {
        return $this->surname;
    }

    public function setSurname(Surname $surname): void
    {
        $this->surname = $surname; 
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function setPassword(Password $password): void
    {
        $this->password = $password;
    }
}
