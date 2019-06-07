<?php

declare(strict_types = 1);

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiHttpResponse extends JsonResponse
{
    /**
     * @param array|null $data
     * @param int $statusCode
     * @param array $headers
     */
    public function __construct(?array $data, int $statusCode = Response::HTTP_OK, array $headers = [])
    {
        parent::__construct($data, $statusCode);
        $this->headers->set('Content-Type', 'application/json');
    }
}
