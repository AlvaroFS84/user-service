<?php

namespace App\Infrastructure\Service\Interface;

interface ResponseServiceinterface{

    public function response(array $data, int $code, array $headers = []);
}