<?php

namespace App\Repository\Read;

use App\Repository\View\ShapeListView;
use App\Repository\View\ShapeView;

interface DbalReadRepository
{
    /**
     * @return int
     */
    public function count() : int;

    /**
     * @param int $shapeId
     * @return ShapeView|null
     */
    public function getById(int $shapeId) : ?ShapeView;

    /**
     * @return ShapeListView
     */
    public function getAll() : ShapeListView;
}