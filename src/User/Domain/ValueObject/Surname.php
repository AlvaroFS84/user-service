<?php

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidParameterException;

    class Surname{

        public function __construct(
            private string $surname
        )
        { 
            $this->validate();
        }

        private function validate()
        {
            if(strlen($this->surname) === 0){
                throw new InvalidParameterException('User surname cannot be empty');
            }
            if(strlen($this->surname) > 255){
                throw new InvalidParameterException('User surname cannot be longer than 255 characters');
            }
        }
    }