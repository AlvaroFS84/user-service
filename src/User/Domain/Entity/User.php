<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\Name;
use App\Domain\ValueObject\Password;
use App\Domain\ValueObject\Surname;
use App\Domain\ValueObject\Id;


class User
{
    public function __construct(
        private Id $id,
        private Name $name,
        private Surname $surname,
        private Email $email,
        private Password $password
    ) {}

    public function getId(): Id
    {
        return $this->id;
    }

    public function setId(Id $id): void
    {
        $this->$id = $id;
    }

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

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): void
    {
        $this->$email = $email;
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
