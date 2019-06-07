<?php

declare(strict_types = 1);

namespace App\Bus\Query;

interface QueryBus
{
    /**
     * @param Query $query
     * @return Response|null
     */
    public function query(Query $query): ? Response;
}
