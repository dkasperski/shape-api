<?php

namespace App\Repository\Write;

use App\Entity\Shape\Shape;

interface DoctrineWriteRepository
{
    /**
     * @param Shape $shape
     * @return bool
     */
    public function save(Shape $shape) :bool;
}