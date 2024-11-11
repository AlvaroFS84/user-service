<?php

namespace App\User\Domain\ValueObject;

class Email
{
    public function __construct(private string $value)
    {}

    public function value(): string
    {
        return $this->value;
    }
}