<?php

namespace App\User\Infrastructure\Service\Interface;

interface ResponseServiceInterface{

    public function response(array $data, int $code, array $headers = []);
}