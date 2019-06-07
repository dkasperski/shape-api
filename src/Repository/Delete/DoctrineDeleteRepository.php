<?php

namespace App\Repository\Delete;

use App\Entity\Shape\Shape;

interface DoctrineDeleteRepository
{
    /**
     * @param Shape $shape
     * @return bool
     */
    public function remove(Shape $shape) :bool;
}