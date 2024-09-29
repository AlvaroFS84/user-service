<?php

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidParameterException;

    class Name{

        public function __construct(
            private string $name
        )
        { 
            $this->validate();
        }

        private function validate()
        {
            if(strlen($this->name) === 0){
                throw new InvalidParameterException('User name cannot be empty');
            }
            if(strlen($this->name) > 255){
                throw new InvalidParameterException('User name cannot be longer than 255 characters');
            }
        }
    }