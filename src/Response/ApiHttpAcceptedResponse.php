<?php

declare(strict_types = 1);

namespace App\Response;

use Symfony\Component\HttpFoundation\Response;

final class ApiHttpAcceptedResponse extends ApiHttpResponse
{
    /**
     * ApiHttpAcceptedResponse constructor.
     * @param string $currentUrl
     * @param array $headers
     */
    public function __construct(string $currentUrl, array $headers = [])
    {
        parent::__construct(
            [],
            Response::HTTP_ACCEPTED,
            array_merge(['Location' => sprintf('%s/status/%s', $currentUrl)], $headers)
        );
    }
}
