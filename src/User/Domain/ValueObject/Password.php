<?php

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidParameterException;

    class Password{

        public function __construct(
            private string $password
        )
        { 
            $this->validate();
        }

        private function validate()
        {
            if(strlen($this->password) === 0){
                throw new InvalidParameterException('User password cannot be empty');
            }
            if(strlen($this->password) > 255){
                throw new InvalidParameterException('User password cannot be longer than 255 characters');
            }
        }

        public function value(): string
        {
            return $this->password;
        }
    }