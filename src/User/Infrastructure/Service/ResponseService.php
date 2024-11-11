<?php

namespace App\User\Infrastructure\Service;

use App\User\Infrastructure\Service\Interface\ResponseServiceinterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseService implements ResponseServiceinterface{

    public function response(array $data, int $code, array $headers = []):JsonResponse
    {
        $responseData = json_encode($data);

        return new JsonResponse($responseData, $code, $headers, JSON_UNESCAPED_UNICODE);
    }
}