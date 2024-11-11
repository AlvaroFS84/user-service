<?php

namespace App\User\Domain\ValueObject;

use App\Domain\Exception\InvalidParameterException;

    class Password{

        public function __construct(
            private string $value
        )
        { 
            $this->validate();
        }

        private function validate()
        {
            if(strlen($this->value) === 0){
                throw new InvalidParameterException('User password cannot be empty');
            }
            if(strlen($this->value) > 255){
                throw new InvalidParameterException('User password cannot be longer than 255 characters');
            }
        }

        public function value(): string
        {
            return $this->value;
        }
    }