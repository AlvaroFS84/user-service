<?php

namespace App\User\Domain\ValueObject;

use App\User\Domain\Exception\InvalidParameterException;

class Name
{
    public function __construct(
        private string $value
    ) { 
        $this->validate();
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

    public function value(): string
    {
        return $this->value;
    }
}
