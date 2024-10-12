<?php

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidParameterException;

class Id
{
    public function __construct(private string $value)
    {}

    public function value(): string
    {
        return $this->value;
    }

    private function validate(): void
    {
        if (strlen($this->value) === 0) {
            throw new InvalidParameterException('User name cannot be empty');
        }
        if (strlen($this->value) > 255) {
            throw new InvalidParameterException('User name cannot be longer than 255 characters');
        }
    }
}