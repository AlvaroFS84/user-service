<?php

namespace App\Domain\Exception;

use Exception;

class EmailAlreadyExistsException extends Exception
{
    public function __construct(){
        parent::__construct('This email already exists');
    }
}