<?php

declare(strict_types = 1);

namespace App\Response;

use Symfony\Component\HttpFoundation\Response;

final class ApiHttpCreatedResponse extends ApiHttpResponse
{
    /**
     * @param null $data
     * @param array $headers
     */
    public function __construct($data = null, array $headers = [])
    {
        parent::__construct($data, Response::HTTP_CREATED, $headers);
    }
}
