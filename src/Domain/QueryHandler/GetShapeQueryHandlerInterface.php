<?php

namespace App\Domain\QueryHandler;

use App\Domain\Query\GetShapeQuery;
use App\Repository\View\ShapeView;

interface GetShapeQueryHandlerInterface
{
    /**
     * @param GetShapeQuery $getShapeQuery
     * @return ShapeView|null
     */
    public function __invoke(GetShapeQuery $getShapeQuery): ?ShapeView;
}