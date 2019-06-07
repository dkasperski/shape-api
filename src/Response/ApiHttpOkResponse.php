<?php

declare(strict_types = 1);

namespace App\Response;

use Symfony\Component\HttpFoundation\Response;

final class ApiHttpOkResponse extends ApiHttpResponse
{
    /**
     * @param array|null $data
     * @param array $headers
     */
    public function __construct(?array $data, array $headers = [])
    {
        parent::__construct($data, Response::HTTP_OK, $headers);
    }
}