<?php

namespace App\Domain\QueryHandler;

use App\Domain\Query\GetShapeListQuery;
use App\Repository\View\ShapeListView;

interface GetShapeListQueryHandlerInterface
{
    /**
     * @param GetShapeListQuery $getShapeListQuery
     * @return ShapeListView
     */
    public function __invoke(GetShapeListQuery $getShapeListQuery): ShapeListView;
}