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
    )
    {}
}