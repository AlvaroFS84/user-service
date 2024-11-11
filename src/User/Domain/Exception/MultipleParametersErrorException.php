<?php

namespace App\User\Domain\Exception;

use Exception;

class MultipleParametersErrorException extends Exception
{
    
    
    public function __construct(private array $errors){
        parent::__construct(implode(', ', $this->errors));
    }

}